<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\Listing;
use App\Models\ListingReportCategories;

class ReportsController extends Controller
{
    public function submit_report(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'listing_id' => 'required',
            
            
        ]);
        if($validated){
            $lister = Listing::where('listing_id', $request->input('listing_id'))->get();
            $exists_report = Reports::where('listing_id', $request->input('listing_id'))->where('user_id', $request->input('user_id'))->get();
            if(count($exists_report)>0){
                return response()->json([
                    'status' => 403,
                    'messege' => 'Report already submitted'
                ], 403);
            }else{
                Reports::create([
                    'listing_id' => $request->input('listing_id'),
                    'lister_id' => $lister[0]->lister_id,
                    'user_id' => $request->input('user_id'),
                    'report_category_id' => $request->input('report_category_id'),
                    
                    'comments' => $request->input('comments')
                ]);

                return response()->json([
                    'status' => 200,
                    'messege' => 'Report submitted'
                ]);
            }
            
        }else{
            return $validated->errors();
        }
    }

    public function get_report_categories(){
        $reportcategories = ListingReportCategories::all();
        if(count($reportcategories)>0){
            return response()->json([
                'status' => 200,
                'reportcategories' => $reportcategories
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'messege' => 'Not found anything'
            ], 404);
        }
    }
}
