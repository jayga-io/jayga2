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
        $user = User::where('id', $id)->with('avatars')->with('nids')->get();
        $total_bookings = BookingHistory::where('lister_id', $request->query('lister_id'))->where('isComplete', true)->count();
        $listing_count = Listing::where('lister_id', $request->query('lister_id'))->count();
       // $images = UserPictures::where('user_id', $id)->get();
      //  $nid = UserNid::where('user_id', $id)->get();

        if(count($user)>0){
            return response()->json([
            'user_data' => $user,
            'total_listings' => $listing_count,
            'total_bookings' => $total_bookings
            
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
            'id' => 'required',
            
            
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

    
    public function push_notif(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'isPushNotif' => 'required|boolean',
            'FCM_token' => 'string|nullable'
        ]);

        if($validated){
            if($validated['isPushNotif'] == true){
                User::where('id', $validated['user_id'])->update([
                    'isPushNotif' => $validated['isPushNotif'],
                    'FCM_token' => $validated['FCM_token']
                ]);
            }elseif($validated['isPushNotif'] == false){
                User::where('id', $validated['user_id'])->update([
                    'isPushNotif' => $validated['isPushNotif']
                ]);
            }
            return response()->json([
                'status' => 200,
                'messege' => 'Push Notification updated'
            ]);
        }else{
            return $validated->errors();
        }
    }


    public function user_delete(Request $request){
        $validated = $request->validate([
            'user_id' => 'required'
        ]);

        if($validated){
            User::where('id', $request->input('user_id'))->delete();
            Listing::where('lister_id', $request->input('user_id'))->delete();
            return response()->json([
                'status' => 200,
                'messege' => 'User deleted successfully'
            ]);
        }else{
            return $validated->errors();
        }
        
    }
}
