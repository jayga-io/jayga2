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
             'is_lister' => 'boolean',
            
             
            ]);
                    $authKey = 'jayga_user';
                    $authToken = Hash::make($authKey);
                   
                    $user = User::where('phone', $request->phone)->get();
                    
                    
                    
                        if(count($user)>0){

                            User::where('id', $user[0]->id)->update([ 'access_token' => $authToken, 'FCM_token' => $request->input('FCM_token')]);
                            
                            return response()->json([
                                'status' => '200',
                                'messege' => 'User already exist',
                                'user' => [
                                    'user_id' => $user[0]->id,
                                    'phone' => $user[0]->phone,
                                    'authToken' => $authToken,
                                    'name' => $user[0]->name,
                                    'email' => $user[0]->email

                                ]
                                
                            ]);
    
                        }else{
                            User::create([
                                'phone' => $request->input('phone'),
                                'access_token' => $authToken,
                                'FCM_token' => $request->input('FCM_token'),
                            ]);
                            $user = User::where('phone', $request->input('phone'))->get();
                            return response()->json([
                                'status' => '200',
                                'messege' => 'New user registered successfully',
                                'user' => [
                                    'user_id' => $user[0]->id,
                                    'phone' => $user[0]->phone,
                                    'authToken' => $authToken,
                                    'name' => $user[0]->name,
                                    'email' => $user[0]->email
                                ]
                                
                            ]);
                        }
    
                    
           
        }
    }

    public function register(Request $request){
        $validated = $request->validate([
            'user_name' => 'required',
            'user_email' => 'required',
            'user_dob' => 'required',
            'acc_token' => 'required',
           ]);

           

           // $user = User::where('access_token', $request->input('acc_token'))->get();
           if($validated){
                User::where('access_token', $request->input('acc_token'))->update([
                        'name' => $request->input('user_name'),
                        'email' => $request->input('user_email'),
                        'user_dob' => $request->input('user_dob'),
                        'phone' => $request->input('phone'),
                        
                        'user_address' => $request->input('user_address'),
                        'is_lister' => $request->input('is_lister'),
                        'user_long' => $request->input('user_long'),
                        'user_lat' => $request->input('user_lat'),
                        'FCM_token' => $request->input('FCM_token'),
                        'platform_tag' => $request->input('platform_tag'),
                    ]);
                return response()->json([
                        'status' => 200,
                        'messege' => 'user info updated'
                    ]);
           }else{
                return $validated->errors();
           }
                
            
  
           
    }
}
