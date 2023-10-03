<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function signin(Request $request){
        if($request->method() == 'POST'){
           
            $validated = $request->validate([
             'phone' => 'required',
             'is_lister' => 'required|boolean',
            
             
            ]);
                    $authKey = 'jayga_user';
                    $authToken = Hash::make($authKey);
                    if($validated){
                    $user = User::where('phone', $request->phone)->get();
                    
                    
                    
                        if(count($user)>0){

                            User::where('id', $user[0]->id)->update(['access_token' => $authToken, 'FCM_token' => $request->input('FCM_token')]);
                            
                            return response()->json([
                                'status' => '200',
                                'messege' => 'User already exist',
                                'user' => [
                                    'user_id' => $user[0]->id,
                                    'phone' => $user[0]->phone,
                                    'authToken' => $authToken,

                                ]
                                
                            ]);
    
                        }else{
                            return response()->json([
                                'status' => '404',
                                'messege' => 'User not found',
                                
                            ], 404);
                        }
    
                    }else{
                        return $validated->errors();
                    }
           
        }
    }

    public function register(Request $request){
        $validated = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'user_dob' => 'required',
            
           ]);

           
           if($validated){

            $user = User::where('email', $request->input('user_email'))->get();
            if(count($user)>0){

                return response()->json([
                    'status' => 403,
                    'messege' => 'Email in use. Please login instead'
                ], 403);
            }else{

               User::create([
                'name' => $request->input('user_name'),
                'email' => $request->input('user_email'),
                'phone' => $request->input('phone'),
                'user_dob' => $request->input('user_dob'),
                'user_address' => $request->input('user_address'),
                'is_lister' => $request->input('is_lister'),
                'user_long' => $request->input('user_long'),
                'user_lat' => $request->input('user_lat'),
                'FCM_token' => $request->input('FCM_token'),
                'platform_tag' => $request->input('platform_tag'),
            ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'User Registered Successfully',
                                
                ]);

            }
            
            
            
            
           }
    }
}
