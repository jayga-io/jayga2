<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserloginController extends Controller
{
    public function login(Request $request){
        $validated = $request->validate([
            'phone' => 'required'
        ]);

        if($validated){
            $user = User::where('phone', $request->input('phone'))->get();
            $authKey = 'jayga_user';
            $authToken = Hash::make($authKey);
            $otp = random_int(1000,9999);

            if(count($user)>0){

                User::where('id', $user[0]->id)->update([ 'access_token' => $authToken ]);
                
                return response()->json([
                    'status' => '200',
                    'messege' => 'User already exist',
                    'otp' => $otp,
                    'access_token' => $authToken
                    
                ]);

            }else{
                User::create([
                    'phone' => $request->input('phone'),
                    'access_token' => $authToken
                ]);
                
                return response()->json([
                    'status' => '200',
                    'messege' => 'New user registered successfully',
                    'otp' => $otp,
                    'access_token' => $authToken
                    
                ]);
            }
        }else{
            return $validated->errors();
        }
    }

    public function verify_otp(Request $request){
        $validated = $request->validate([
            'access_token' => 'required'
        ]);

        if($validated){
            $user = User::where('access_token', $request->input('access_token'))->with('avatars')->get();
            if(count($user)>0){
                return response()->json([
                    'status' => 200,
                    'user' => $user
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'user' => 'Authentication faild'
                ], 404);
            }
        }else{
            return $validated->errors();
        }
    }
}
