<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserNid;
use App\Models\UserPictures;
use App\Models\UserCoverPhotos;
use App\Models\Listing;
use Storage;

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
                    'about' => $request->input('about'),
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
                    foreach ($up as $item) {
                        Storage::delete($item->user_targetlocation);
                    }
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

    public function user_avatars(Request $request, $id){
        $avatar = UserPictures::where('user_id', $id)->get();
        if(count($avatar)>0){
            return response()->json([
                'status' => true,
                'messege' => $avatar
            ]);
        }else{
            return response()->json([
                'status' => false,
                'messege' => 'No image found'
            ]);
        }
    }

    public function set_cover(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'photo' => 'required'
        ]);
        if($validated){
            $file = $request->file('photo');
            if($file){
                
                
                $path = $file->store('usercovers');
                $up = UserCoverPhotos::where('user_id', $request->input('user_id'))->get();
                if(count($up)>0){
                    foreach ($up as $value) {
                        Storage::delete($value->user_targetlocation);
                    }
                    UserCoverPhotos::where('user_id', $request->input('user_id'))->update([
                        'user_id' => $request->input('user_id'),
                        'user_filename' => $file->hashName(),
                        'user_targetlocation' => $path
                    ]);
                }else{
                    UserCoverPhotos::create([
                        'user_id' => $request->input('user_id'),
                        'user_filename' => $file->hashName(),
                        'user_targetlocation' => $path
                    ]);
                }
                
                return response()->json([
                    'status' => 200,
                    'messege' => 'User Cover photo uploaded'
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

    public function get_cover(Request $request, $id){
        $cover = UserCoverPhotos::where('user_id', $id)->get();
        if(count($cover)>0){
            return response()->json([
                'status' => true,
                'messege' => $cover
            ]);
        }else{
            return response()->json([
                'status' => false,
                'messege' => 'No image found'
            ]);
        }
    }

    public function user_delete(Request $request, $id){
        User::where('id', $id)->delete();
        Listing::where('lister_id', $id)->delete();
        return response()->json([
            'status' => 200,
            'messege' => 'User deleted successfully'
        ]);
    }
}
