<?php

namespace App\Http\Controllers\Frontend\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPictures;
use App\Models\UserNid;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Storage;

class UserloginController extends Controller
{
    public function login(Request $request){
        $validated = $request->validate([
            'emailOrPhone' => 'required'
        ]);

        if($validated){
            $pattern = '/^\S+@\S+\.\S+$/';
            $otp = random_int(1000,9999);
            $txt = $request->input('emailOrPhone');

            if(is_numeric($txt)){
                $data = [
                    "sender_id" => "8809601010510",
                     "receiver" => $txt,
                     "message" => "Your Jayga OTP is:".$otp,
                     "remove_duplicate" => true
                 ];

                 send_sms($data);
            }elseif(preg_match($pattern, $txt)){
                $receipent = $txt;
                $subject = 'Jayga OTP';
     
                 Mail::plain(
                    view: 'mailTemplates.Otp',
                    data: [
                        'otp' => $otp
                    ],
                    callback: function (Message $message) use ($receipent, $subject) {
                        $message->to($receipent)->subject($subject);
                    }
                );
            }

            return response()->json([
                'status' => '200',
                //'messege' => 'New user registered successfully',
                'phone' => $txt,
                'otp' => $otp,
                //'access_token' => $authToken
                
            ]);
        }else{
            return $validated->errors();
        }
    }

    public function verify_otp(Request $request){
        $validated = $request->validate([
            'emailOrPhone' => 'required'
        ]);

        if($validated){
            $authKey = 'jayga_user';
            $authToken = Hash::make($authKey);
            $pattern = '/^\S+@\S+\.\S+$/';
            $user = User::where('phone', $request->input('emailOrPhone'))->orWhere('email', $request->input('emailOrPhone'))->get();
            if(count($user)>0){
                if($user[0]->isSuspended == true){
                    return response()->json([
                        'status' => 403,
                        'messege' => 'User account suspended. Please contact with Jayga support'
                    ], 403);
                }

                User::where('id', $user[0]->id)->update([
                    'access_token' => $authToken
                ]);

                $updatedUser = User::where('phone', $request->input('emailOrPhone'))->orWhere('email', $request->input('emailOrPhone'))->get();

                return response()->json([
                    'status' => 200,
                    'user' => $updatedUser
                ]);
                
            }else{
                if(is_numeric($request->input('emailOrPhone'))){
                    User::create([
                        'phone' => $request->input('emailOrPhone'),
                        'access_token' => $authToken
                    ]);
                }elseif(preg_match($pattern, $request->input('emailOrPhone'))){
                    User::create([
                        'email' => $request->input('emailOrPhone'),
                        'access_token' => $authToken
                    ]);
                }
                $newUser = User::where('phone', $request->input('emailOrPhone'))->orWhere('email', $request->input('emailOrPhone'))->get();
                return response()->json([
                    'status' => 200,
                    'messege' => 'new user created',
                    'user' => $newUser
                ]);
            }
        }else{
            return $validated->errors();
        }
    }



    public function get_user(Request $request){
        $validated = $request->validate([
            'phoneOrEmail' => 'required'
        ]);

        if($validated){
            $us = User::where('phone', $request->query('phoneOrEmail'))->orWhere('email', $request->query('phoneOrEmail'))->with('avatars')->with('nids')->get();
                if(count($us)>0){
                    if($us[0]->isSuspended == true){
                        return response()->json([
                            'status' => 403,
                            'messege' => 'User account suspended. Please contact with Jayga support'
                        ], 403);
                    }else{
                        return response()->json([
                            'status' => 200,
                            'user' => $us
                        ]);
                    }
                    
                }else{
                    return response()->json([
                        'status' => 404,
                        'user' => 'No user found'
                    ], 404);
                }
        }else{
            return $validated->errors();
        }

        
    }

    public function update_user(Request $request){
        $validated = $request->validate([
            'id' => 'integer|required',
            'email' => 'string',
            'phone' => 'string',
            
        ]);

        if($validated){
            $checkConflict = User::where('phone', $request->input('phone'))->orWhere('email', $request->input('email'))->get();
                
                if(count($checkConflict)>0){
                    if($checkConflict[0]->phone == null || $checkConflict[0]->email == null){
                        User::where('id', $request->input('id'))->update($request->all());
                        return response()->json([
                            'status' => 200,
                            'messege' => 'User information updated'
                        ]);
                    }else{
                        return response()->json([
                            'status' => 403,
                            'messege' => 'Phone number / Email already taken'
                        ], 403);
                    }
                    
                }else{
                    User::where('id', $request->input('id'))->update($request->all());
                    return response()->json([
                        'status' => 200,
                        'messege' => 'User information updated'
                    ]);
                }
            
        }else{
            return $validated->errors();
        }
    }
}
