<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

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
                    $pattern = '/^\S+@\S+\.\S+$/';
                    $txt = $request->input('phone');

                    if(preg_match($pattern, $txt)){
                        $to_email = $request->input('phone');
                        $subject = 'Jayga OTP';
                        $message = '

                        Dear user,
                        
                        Your One-Time Password (OTP) for accessing your Jayga account is:  '.$otp.' .
                        
                        Please enter this code on the login page to complete the verification process.
                        
                        Please note that this OTP is valid for a single use only and should not be shared with anyone. If you did not request this OTP, please disregard this message.
                        
                        Thank you for using Jayga!
                        
                        Best regards,
                        The Jayga Team';

                        // Send email
                        Mail::raw($message, function($message) use ($to_email, $subject) {
                            $message->to($to_email)->subject($subject);
                        });
                    }

                    $user = User::where('phone', $request->phone)->orWhere('email', $request->phone)->get();
                    
                    
                    
                        if(count($user)>0){

                            if($user[0]->isSuspended == true){
                                return response()->json([
                                    'status' => 403,
                                    'messege' => 'User account suspended. Please contact with Jayga support'
                                ], 403);
                            }else{
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
                            }

                            
    
                        }else{
                            if(is_numeric($txt)){
                                User::create([
                                    'phone' => $request->input('phone'),
                                    'access_token' => $authToken,
                                    'FCM_token' => $request->input('FCM_token'),
                                ]);
                            }elseif(preg_match($pattern, $txt)){
                                User::create([
                                    'email' => $request->input('phone'),
                                    'access_token' => $authToken,
                                    'FCM_token' => $request->input('FCM_token'),
                                ]);
                            }
                            
                            $user = User::where('phone', $request->input('phone'))->orWhere('email', $request->input('phone'))->get();
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
