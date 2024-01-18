<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingGuestAmenities;
use App\Models\ListingRestrictions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::with('images')->with('reviews')->take(8)->get();
        
       // dd($listings[0]->reviews[0]->avg_rating);
       return view('client.home.home')->with('listings', $listings);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $listing = Listing::where('listing_id', $id)->with('images')->with('reviews')->with('host.avatars')->get();
       
            $amenitiesColumnsWithValueOne = [];
            $tableName = (new ListingGuestAmenities)->getTable();

            // Get all column names from the table
            $columnNames = Schema::getColumnListing($tableName);

            // Loop through each column and check if the value is 1 in any record
            foreach ($columnNames as $columnName) {
                $count = ListingGuestAmenities::where($columnName, 1)->where('listing_id', $listing[0]->listing_id)->count();
                if ($count > 0) {
                    $amenitiesColumnsWithValueOne[] = $columnName;
                }
            }

           $restrictionColumnsWithValueOne = [];

           $tableName = (new ListingRestrictions)->getTable();

           // Get all column names from the table
           $columnNames = Schema::getColumnListing($tableName);

           // Loop through each column and check if the value is 1 in any record
           foreach ($columnNames as $columnName) {
               $count = ListingRestrictions::where($columnName, 1)->where('listing_id', $listing[0]->listing_id)->count();
               if ($count > 0) {
                   $restrictionColumnsWithValueOne[] = $columnName;
               }
           }

          // dd($listing);

        return view('client.home.single-listing')->with('listing', $listing)->with('amenities', $amenitiesColumnsWithValueOne)->with('restrictions', $restrictionColumnsWithValueOne);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
