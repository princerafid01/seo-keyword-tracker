<?php

namespace App\Http\Controllers;

use App\Models\RankingKeyword;
use App\Models\RankingLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RankingKeywordController extends Controller
{
    public function getRankings()
    {
        $data = RankingKeyword::select('*');
        return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('location_id', function(RankingKeyword $keyword){
                        return $keyword->location->name;
                    })
                    ->editColumn('meta', function(RankingKeyword $keyword){
                        $meta =  collect($keyword->meta)->map(function($ranking){
                            return [
                                'time' => Carbon::parse($ranking['time'])->diffForHumans(),
                                'website_position' => $ranking['website_position']
                            ];
                        });

                        // dd($keyword->meta);

                        $html = '<ul>';

                        $meta->map(function($data) use(&$html){
                            $html .= '<li> Position was on '. $data['website_position'] . ' - ' .$data['time'] . '.</li>';
                        });
                        $html .= '<ul>';

                        return $html;
                    })
                    ->addColumn('action', function(RankingKeyword $keyword){

                        $btn = '<a href='. route('regenerate.ranking.keyword',[$keyword->id]) .' class="edit btn btn-primary btn-sm">Regenerate Ranking</a>';

                        return $btn;
                    })
                    ->rawColumns(['action', 'meta'])
                    ->make(true);
    }

    public function regenerate_ranking_keyword($keyword_id)
    {
        $keyword = RankingKeyword::find($keyword_id)->load('location');

        $responses = Http::withBasicAuth(
            config('seotracker.serp_api_mail'),
            config('seotracker.serp_api_password')
        )->post('https://api.dataforseo.com/v3/serp/google/organic/live/advanced', [
            [
                'language_name' => 'English (United Kingdom)',
                'location_name' => $keyword->location->name,
                'keyword' => $keyword->keyword,
                'se_domain' => 'google.com',
            ]
        ]);

        $collected_data =  collect(collect($responses->object()->tasks)->first()->result[0]->items)->filter(function($item) use ($keyword){
            return Str::contains($item->domain ?? '', $keyword->website);
        });

        $website_position = $collected_data->first()->rank_group;

        $data['website_position'] = $website_position;
        $data['website_name'] = $keyword->website;
        $data['keyword'] = $keyword->keyword;

        // create or update
        $location = RankingLocation::updateOrCreate([
            'name' => strtolower($keyword->location->name)
        ],[]);

        $keyword = RankingKeyword::updateOrCreate(
            [
                'location_id' =>  $location->id,
                'keyword' =>  $keyword->keyword,
                'website' =>  $keyword->website
            ],
            [
                'current_ranking' => $website_position
            ]
        );

        // !isset($keyword->meta)  ?$keyword->meta,

        if(!isset($keyword->meta)){
            $keyword->update([
                'meta' =>[
                    [
                        'time' => Carbon::now(),
                        'website_position' => $website_position
                    ]
                ]
            ]);
        } else {
            $keyword->update([
                'meta' =>[
                    ...$keyword->meta,
                    [
                        'time' => Carbon::now(),
                        'website_position' => $website_position
                    ]
                ]
            ]);
        }

        return back()->with('data', $data);
    }
}
