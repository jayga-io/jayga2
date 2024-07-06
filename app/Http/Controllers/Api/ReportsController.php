<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reports;

class ReportsController extends Controller
{
    public function submit_report(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'listing_id' => 'required',
            'lister_id' => 'required',
            
        ]);
        if($validated){
            Reports::create([
                'listing_id' => $request->input('listing_id'),
                'lister_id' => $request->input('lister_id'),
                'user_id' => $request->input('user_id'),
                'report_category_id' => $request->input('report_category_id'),
                
                'comments' => $request->input('comments')
            ]);

            return response()->json([
                'status' => 200,
                'messege' => 'Report submitted'
            ]);
        }else{
            return $validated->errors();
        }
    }
}
