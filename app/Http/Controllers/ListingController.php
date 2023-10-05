<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      if($request->method() == 'POST'){
       
       Listing::create([
        'guest_number' => $request->input('guest_num'),
        'bed_number' => $request->input('bedroom_num'),
        'bathroom_number' => $request->input('bathroom_num'),
        'listing_title' => $request->input('listing_title'),
        'listing_description' => $request->input('describe_listing'),
        'full_day_price_set_by_user' => $request->input('price'),
        'listing_address' => $request->input('listing_address'),
        'zip_code' => $request->input('zip_code'),
        'district' => $request->input('district'),
        'town' => $request->input('town'),
        'allow_short_stay' => $request->input('allow_short_stay'),
        'describe_peaceful' => $request->input('peaceful'),
        'describe_unique' => $request->input('unique'),
        'describe_familyfriendly' => $request->input('family_friendly'),
        'describe_stylish' => $request->input('stylish'),
        'describe_central' => $request->input('central'),
        'describe_spacious' => $request->input('spacious'),
        'private_bathroom' => $request->input('private_bathroom'),
        'door_lock' => $request->input('door_lock'),
        'breakfast_included' => $request->input('breakfast_included'),
        'unknown_guest_entry' => $request->input('unknown_guest_entry'),
        'listing_type' => $request->input('listing_type'),
       ]);

       


       return view('admin.dashboard');
      } 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingRequest $request, Listing $listing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }
}
