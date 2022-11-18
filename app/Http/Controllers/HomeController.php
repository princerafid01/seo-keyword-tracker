<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

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
}
