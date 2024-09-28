<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeSlotShortstays;

class TimeSlotsController extends Controller
{
    public function timeslots(Request $request){
        $slots = TimeSlotShortstays::all();
        Session(['pip'=>'J@yga2024']);
        if(count($slots)>0){
            return response()->json([
                'status' => 200,
                'timeslots' => $slots
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'messege' => 'Not found'
            ], 404);
        }
    }
}
