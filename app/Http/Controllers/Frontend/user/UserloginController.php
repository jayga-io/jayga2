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
            /*
            'name' => 'string',
            
            'user_nid' => 'Integer',
            'user_dob' => 'string',
            'user_address' => 'string',
            'user_lat' => 'double',
            'user_long' => 'double',
            'about' => 'string',
            'platform_tag' => 'string',
            */
        ]);

        if($validated){
            $id = $request->input('id');
            $conflictCheck = User::where('phone', $request->input('phone'))->orWhere('email', $request->input('email'))->get();

            if(count($conflictCheck)>0){
                return response()->json([
                    'status' => 403,
                    'messege' => 'Phone number / Email already taken'
                ], 403);
            }else{
                 User::where('id', $id)->update($request->all());
                 return response()->json([
                    'status' => 200,
                    'message' => 'User information updated'
                ]);
            }
           

            /*
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
            */

            
        }else{
            return $validated->errors();
        }
    }
}
