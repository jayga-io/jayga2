<?php

namespace App\Http\Controllers\Host;
use App\Http\Controllers\Controller;

use App\Models\ListerUser;
use App\Http\Requests\StoreListerUserRequest;
use App\Http\Requests\UpdateListerUserRequest;
use App\Models\User;
use App\Models\UserNid;
use App\Models\UserPictures;
use Illuminate\Http\Request;

class ListerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->session()->get('user');
        $user = User::where('id', $id)->get();
        $dp = UserPictures::where('user_id', $id)->get();
    
        return view('host.profile.profile')->with('user', $user)->with('dp', $dp);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->session()->get('user');
        User::where('id', $id)->update([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'user_address' => $request->input('address'),
            'user_dob' => $request->input('dob'),
        ]);

        $user = User::where('id', $id)->get();
        session([ 
            'user' => $user[0]->id,
            'user_name' => $user[0]->name,
            'phone' => $user[0]->phone,
            'user_email' => $user[0]->email,
            
            ]);



        if($file = $request->hasFile('profile_picture')){
           $path = $file->store('useravatars');
           $up = UserPictures::where('user_id', $id)->get();
           if(count($up)>0){
            UserPictures::where('user_id', $id)->update([
                'user_id' => $id,
                'user_filename' => $file->hashName(),
                'user_targetlocation' => $path
            ]);

            $photo = UserPictures::where('user_id', $id)->get();
            session([
                
                'photo' => $photo[0]->user_targetlocation,
            ]);

           }else{
            UserPictures::create([
                'user_id' => $id,
                'user_filename' => $file->hashName(),
                'user_targetlocation' => $path
            ]);

            $photo = UserPictures::where('user_id', $id)->get();
            session([
                
                'photo' => $photo[0]->user_targetlocation,
            ]);


           }
            
        }

        if($nids = $request->hasFile('nid')){
            $src = $nids->store('user_nids');
            $nid = UserNid::where('user_id', $id)->get();
            if(count($nid)>0){
                UserNid::where('user_id', $id)->update([
                     'user_id' => $id ,
                     'user_nid_filename' => $nids->hashName(), 
                     'user_nid_targetlocation' => $src 
                    
                     
                 ]);
            }else{
                UserNid::create([
                    'user_id' => $id ,
                    'user_nid_filename' => $nids->hashName(), 
                    'user_nid_targetlocation' => $src 
                   
                    
                ]);
            }
          
        }
        toastr()->addSuccess('User information updated');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListerUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ListerUser $listerUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListerUser $listerUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListerUserRequest $request, ListerUser $listerUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListerUser $listerUser)
    {
        //
    }
}
