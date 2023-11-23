<?php

namespace App\Http\Controllers;

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
        if($file = $request->file('profile_picture')){
           $path = $file->store('useravatars');
            UserPictures::updateOrCreate([
                'user_id' => $id,
                'user_filename' => $file->hashName(),
                'user_targetlocation' => $path,
            ]);
        }

        if($nids = $request->file('nid')){
            $src = $nids->store('user_nids');
            UserNid::updateOrCreate([
                'user_id' => $id,
                'user_nid_filename' => $nids->hashName(),
                'user_nid_targetlocation' => $src,
            ]);
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
