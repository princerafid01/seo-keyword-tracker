<?php

namespace App\Http\Controllers;

use App\Models\RankingKeyword;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function locations()
    {
        // Using Eloquent
        $file_path = Storage::disk('local')->path('locations.csv');

        // $rows is an instance of Illuminate\Support\LazyCollection
        $rows = SimpleExcelReader::create($file_path)->getRows();
        $locations = [];

        $rows->each(function(array $rowProperties ) use(&$locations) {
            $locations[] = Arr::first(array_values( Arr::only($rowProperties, ['location_name'])));
        });

        return $locations;
    }

    public function index()
    {
        $locations = $this->locations();

        return view('home')->with('locations', $locations);
    }

    public function search(Request $request)
    {
        $responses = Http::withBasicAuth(
            config('seotracker.serp_api_mail'),
            config('seotracker.serp_api_password')
        )->post('https://api.dataforseo.com/v3/serp/google/organic/live/advanced', [
            [
                'language_name' => 'English (United Kingdom)',
                'location_name' => $request->location,
                'keyword' => $request->keyword,
                'se_domain' => $request->google_domain,
            ]
        ]);

        $collected_data =  collect(collect($responses->object()->tasks)->first()->result[0]->items)->filter(function($item) use ($request){
            return Str::contains($item->domain ?? '', $request->website_name);
        });

        $website_position = $collected_data->first()->rank_group;

        $data['website_position'] = $website_position;
        $data['website_name'] = $request->website_name;
        $data['keyword'] = $request->keyword;

        // create or update
        // RankingKeyword::create([]);
        // RankingKeyword::create([]);

        return back()->with('data', $data);
    }
}
