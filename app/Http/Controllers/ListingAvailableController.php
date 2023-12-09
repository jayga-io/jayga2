<?php

namespace App\Http\Controllers;

use App\Models\ListingAvailable;
use App\Http\Requests\StoreListingAvailableRequest;
use App\Http\Requests\UpdateListingAvailableRequest;

class ListingAvailableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingAvailableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ListingAvailable $listingAvailable)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListingAvailable $listingAvailable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingAvailableRequest $request, ListingAvailable $listingAvailable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListingAvailable $listingAvailable)
    {
        //
    }
}
