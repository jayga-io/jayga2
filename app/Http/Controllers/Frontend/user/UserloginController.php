<?php

namespace App\Http\Controllers\Frontend\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPictures;
use App\Models\UserNid;
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

                $data = [
                    "sender_id" => "8809601010510",
                     "receiver" => $request->input('phone'),
                     "message" => "Your Jayga OTP is:".$otp,
                     "remove_duplicate" => true
                 ];

                 send_sms($data);
                
                return response()->json([
                    'status' => '200',
                    'messege' => 'User already exist',
                    'phone' => $request->input('phone'),
                    'otp' => $otp,
                    'access_token' => $authToken
                    
                ]);

            }else{
                User::create([
                    'phone' => $request->input('phone'),
                    'access_token' => $authToken
                ]);

                $data = [
                    "sender_id" => "8809601010510",
                     "receiver" => $request->input('phone'),
                     "message" => "Your Jayga OTP is:".$otp,
                     "remove_duplicate" => true
                 ];

                 send_sms($data);
                
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



    public function get_user(Request $request){
        $us = User::where('phone', $request->query('phone'))->with('avatars')->with('nids')->get();
        if(count($us)>0){
            return response()->json([
                'status' => 200,
                'user' => $us
            ]);
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
            User::where('id', $id)->update([
                'name' => $request->input('username'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'user_address' => $request->input('address'),
                'user_dob' => $request->input('dob'),
            ]);

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
                $nids = UserNid::where('user_id')->get();
                if(count($nids)>0){
                    foreach ($nids as $value) {
                        Storage::delete($value->user_nid_targetlocation);
                    }
                    UserNid::where('user_id', $id)->delete();

                    foreach ($nid as $value) {
                        $path = $nid->store('user_nids');
                        UserNid::create([
                            'user_id' => $id ,
                            'user_nid_filename' => $nids->hashName(), 
                            'user_nid_targetlocation' => $path 
                           
                            
                        ]);
                    }

                }else{
                    foreach ($nid as $value) {
                        $path = $nid->store('user_nids');
                        UserNid::create([
                            'user_id' => $id ,
                            'user_nid_filename' => $nids->hashName(), 
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
