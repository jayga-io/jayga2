<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ListingUtility;
use Illuminate\Http\Request;




class ListingUtilityController extends Controller
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
        $validate = $request->validate([
            'lister_id' => 'required',
            'listing_id' => 'required',
            'utility_file' => 'required',
            
        ]);
        if($validate){
            $file = $request->file('utility');
            $path = $file->store('listing_utility');

            ListingUtility::create([
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'utility_filename' => $path->hashName(),
                'utility_filelocation' => $path,
            ]);

            return response()->json([
                'status' => 200,
                'messege' => 'Utility added'
            ]);
        }else{
            return $validate->errors();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListingUtilityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ListingUtility $listingUtility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListingUtility $listingUtility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingUtilityRequest $request, ListingUtility $listingUtility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListingUtility $listingUtility)
    {
        //
    }
}
