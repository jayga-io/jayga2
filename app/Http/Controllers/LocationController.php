<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(){
        $locations = \File::json('locations.json');
       // dd($locations);

       return response()->json([
        'status' => 200,
        'locations' => $locations
       ]);
    }
}
