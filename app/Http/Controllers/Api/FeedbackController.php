<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;



class FeedbackController extends Controller
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
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        if($validated){
            Feedback::create([
                'user_id' => $request->input('user_id'),
                'title' => $request->input('title'),
                'note' => $request->input('note'),
                'type' => $request->input('type'),
            ]);

            return response()->json([
                'status' => 200,
                'messege' => 'Feedback sent successfully'
            ]);
        }else{
            return $validated->errors();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
