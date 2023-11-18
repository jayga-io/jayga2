<?php

namespace App\Http\Controllers;

use App\Models\FavListing;
use App\Http\Requests\StoreFavListingRequest;
use App\Http\Requests\UpdateFavListingRequest;

class FavListingController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavListingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FavListing $favListing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FavListing $favListing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavListingRequest $request, FavListing $favListing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FavListing $favListing)
    {
        //
    }
}
