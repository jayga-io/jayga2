<?php

namespace App\Http\Controllers;

use App\Models\Firebase;
use App\Http\Requests\StoreFirebaseRequest;
use App\Http\Requests\UpdateFirebaseRequest;
use Illuminate\Http\Request;

class FirebaseController extends Controller
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
        $server_key = $request->input('server_key');
        $check = Firebase::where('server_key', $server_key)->get();
        if(count($check)>0){
            Firebase::where('server_key', $server_key)->update([
                'server_key' => $server_key,
            ]);
            return response()->json([
                'status' => 200,
                'messege' => 'Server key updated'
            ]);
        }else{
            Firebase::create([
                'server_key' => $server_key,
                'url' => $request->input('url'),
            ]);
            return response()->json([
                'status' => 200,
                'messege' => 'Server key created'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFirebaseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Firebase $firebase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Firebase $firebase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFirebaseRequest $request, Firebase $firebase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Firebase $firebase)
    {
        //
    }
}
