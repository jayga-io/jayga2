<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vouchar;

class VoucharController extends Controller
{
    public function get_vouchar(Request $request){
        $validated = $request->validate([
            'vouchar_code' => 'required'
        ]);
            
        
        if($validated){
            $vouchars = Vouchar::where('vouchar_code', $request->input('vouchar_code'))->get();
            if(count($vouchars) > 0){
                return response()->json([
                    'status' => 200,
                    'vouchar_details' => $vouchars
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'Vouchar not found'
                ], 404);
            }
        }else{
            return $validated->errors();
        }
    }
}
