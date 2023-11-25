<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserNid;
use App\Models\UserPictures;

class UserController extends Controller
{
    public function getUser(Request $request, $id){
        $user = User::where('id', $id)->get();
        $images = UserPictures::where('user_id', $id)->get();
        $nid = UserNid::where('user_id', $id)->get();

        if(count($user)>0){
            return response()->json([
            'user_data' => $user,
            'user_nid' => $nid,
            'user_pictures' => $images
        ]);
        }else{
            return response()->json([
                'status' => 404,
                'messege' => 'No user found'
            ]);
        }
        
    }

    public function editUser(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'user_name' => 'required',
            'user_email' => 'required',
            'user_dob' => 'required',
            'user_nid' => 'required',
            'user_address' => 'required',
            
            'is_lister' => 'required',
            
           ]);

           if($validated){
                    User::where('id', $request->input('user_id'))->update([
                    'name' => $request->input('user_name'),
                    'email' => $request->input('user_email'),
                    'user_dob' => $request->input('user_dob'),
                    'phone' => $request->input('phone'),
                    'user_nid' => $request->input('user_nid'),
                    'user_address' => $request->input('user_address'),
                    'is_lister' => $request->input('is_lister'),
                    'user_long' => $request->input('user_long'),
                    'user_lat' => $request->input('user_lat'),
                    'FCM_token' => $request->input('FCM_token'),
                    'platform_tag' => $request->input('platform_tag'),
                ]);

             

                return response()->json([
                    'status' => 200,
                    'messege' => 'User information updated'
                ]);
           }else{
                return $validated->errors();
           }
        
    }

    public function photos(Request $request){
        
        $validated = $request->validate([
            'user_id' => 'required',
            'photo' => 'required'
        ]);
        if($validated){
            $file = $request->file('photo');
            if($file){
                
                
                $path = $file->store('useravatars');
                $up = UserPictures::where('user_id', $request->input('user_id'))->get();
                if(count($up)>0){
                    UserPictures::where('user_id', $request->input('user_id'))->update([
                        'user_id' => $request->input('user_id'),
                        'user_filename' => $file->hashName(),
                        'user_targetlocation' => $path
                    ]);
                }else{
                    UserPictures::create([
                        'user_id' => $request->input('user_id'),
                        'user_filename' => $file->hashName(),
                        'user_targetlocation' => $path
                    ]);
                }
                
                return response()->json([
                    'status' => 200,
                    'messege' => 'User avatar uploaded'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No picture uploaded'
                ], 404);
            } 
        }else{
            return $validated->errors();
        }
        
    }

    public function nid(Request $request){
        $file = $request->file('nid_picture');
        $validated = $request->validate([
            'user_id' => 'required',
            'nid_picture' => 'required'
        ]);
        if($validated){
            if(count($file)>0){

                $nid = UserNid::where('user_id', $request->input('user_id'))->get();
                    if(count($nid)>0){
                        foreach ($file as $f) {
                            $path = $f->store('user_nids');
                            UserNid::where('user_id', $request->input('user_id'))->update([
                            'user_id' => $request->input('user_id') ,
                            'user_nid_filename' => $f->hashName(), 
                            'user_nid_targetlocation' => $path 
 
                        ]);
                        }
                        
                    }else{
                        foreach ($file as $f) {
                            $path = $f->store('user_nids');
                             UserNid::create([
                            'user_id' => $request->input('user_id') ,
                            'user_nid_filename' => $f->hashName(), 
                            'user_nid_targetlocation' => $path 
                        
                            
                        ]);
                        }
                       
                    }
                
                
                return response()->json([
                    'status' => 200,
                    'messege' => 'Nid Picture uploaded'
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No picture uploaded'
                ], 404);
            } 
        }else{
            return $validated->errors();
        }
        
    }
}
