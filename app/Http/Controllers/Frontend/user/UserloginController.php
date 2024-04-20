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
            'phone' => 'required'
        ]);

        if($validated){
            $user = User::where('phone', $request->input('phone'))->orWhere('email', $request->input('phone'))->get();
            $authKey = 'jayga_user';
            $authToken = Hash::make($authKey);
            $otp = random_int(1000,9999);
            $pattern = '/^\S+@\S+\.\S+$/';

            $txt = $request->input('phone');

            if(is_numeric($txt)){
                $data = [
                    "sender_id" => "8809601010510",
                     "receiver" => $request->input('phone'),
                     "message" => "Your Jayga OTP is:".$otp,
                     "remove_duplicate" => true
                 ];

                 send_sms($data);
            }elseif(preg_match($pattern, $txt)){
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

            if(count($user)>0){

                User::where('id', $user[0]->id)->update([ 'access_token' => $authToken ]);

                
                
                return response()->json([
                    'status' => '200',
                    'messege' => 'User already exist',
                    'phone' => $request->input('phone'),
                    'otp' => $otp,
                    'access_token' => $authToken
                    
                ]);

            }else{
                if(is_numeric($txt)){
                    User::create([
                        'phone' => $request->input('phone'),
                        'access_token' => $authToken
                    ]);
                }elseif(preg_match($pattern, $txt)){
                    User::create([
                        'email' => $request->input('phone'),
                        'access_token' => $authToken
                    ]);
                }
                

             
                
                return response()->json([
                    'status' => '200',
                    'messege' => 'New user registered successfully',
                    'phone' => $request->input('phone'),
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
                if($user[0]->isSuspended == true){
                    return response()->json([
                        'status' => 403,
                        'messege' => 'User account suspended. Please contact with Jayga support'
                    ], 403);
                }else{
                    return response()->json([
                        'status' => 200,
                        'user' => $user
                    ]);
                }
                
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



    public function get_user(Request $request){
        $us = User::where('phone', $request->query('phone'))->orWhere('email', $request->query('phone'))->with('avatars')->with('nids')->get();
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
    }

    public function update_user(Request $request){
        $validated = $request->validate([
            'user_id' => 'integer',
            'username' => 'string',
            'email' => 'string',
            'phone' => 'string',
        ]);

        if($validated){
            $id = $request->input('user_id');
            User::where('id', $id)->update($request->all());

            if($file = $request->file('photo')){
                $avatar = UserPictures::where('user_id', $id)->get();
                if(count($avatar)>0){
                    Storage::delete($avatar[0]->user_targetlocation);
                    $path = $file->store('useravatars');
                    UserPictures::where('user_id', $id)->update([
                        'user_id' => $id,
                        'user_filename' => $file->hashName(),
                        'user_targetlocation' => $path
                    ]);
                }else{
                    $path = $file->store('useravatars');
                    UserPictures::create([
                        'user_id' => $id,
                        'user_filename' => $file->hashName(),
                        'user_targetlocation' => $path
                    ]);
                }
            }

            if($nid = $request->file('nid')){
                $nids = UserNid::where('user_id', $id)->get();
                if(count($nids)>0){
                    foreach ($nids as $value) {
                        Storage::delete($value->user_nid_targetlocation);
                    }
                    foreach ($nid as $values) {
                        $path = $values->store('user_nids');
                        
                        UserNid::where('user_id', $id)->update([
                            'user_id' => $id ,
                            'user_nid_filename' => $values->hashName(), 
                            'user_nid_targetlocation' => $path 
                           
                            
                        ]);
                    }

                }else{
                    foreach ($nid as $item) {
                        $path = $item->store('user_nids');
                        UserNid::create([
                            'user_id' => $id ,
                            'user_nid_filename' => $item->hashName(), 
                            'user_nid_targetlocation' => $path 
                           
                            
                        ]);
                    }
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'User information updated'
            ]);
        }else{
            return $validated->errors();
        }
    }
}
