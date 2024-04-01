<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListerDashboard;


class AccountDashboardController extends Controller
{
    public function dashboard(Request $request){
        $valid = $request->validate([
            'lister_id' => 'required',
        ]);

        if($valid){
            $dash = ListerDashboard::where('lister_id', $request->query('lister_id'))->get();
            if(count($dash)>0){
                return response()->json([
                    'status' => 200,
                    'dashboard' => $dash
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'dashboard' => 'No info found'
                ], 404);
            }
        }else{
            return $valid->errors();
        }
        
    }
}
