<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPictures;


class ClientLoginController extends Controller
{
    public function index(){
        return view('client.login');
    }

    public function otp(Request $request){
        $otp = random_int(1000,9999);
        $phone = $request->input('phone');
        session([
            'otp' => $otp,
            'phone' => $phone,
        ]); 

    
        return view('client.otp')->with('code', $otp);
    }


    public function verify(Request $request){
        $code = $request->input('OTP');
        $session = $request->session()->get('otp');
        $phone = $request->session()->get('phone');
        if($code == $session){
            $user = User::where('phone', $phone)->get();
           // 
           if(count($user)>0){
            $photo = UserPictures::where('user_id', $user[0]->id)->get();
            if(count($photo)>0){
                session([
                    'photo' => $photo[0]->user_targetlocation,
                ]);
            }else{
                    session([ 
                    'user' => $user[0]->id,
                    'user_name' => $user[0]->name,
                    'user_email' => $user[0]->email,
                    
                ]);
            }
            
           }else{
            User::create([
                'phone' => $phone
            ]);
            $id = User::where('phone', $phone)->get();
           
            session([ 
                'user' => $id[0]->id,
                'user_name' => $id[0]->name,
                'user_email' => $id[0]->email,
                
            ]);
           }
           // dd(session()->all());
            return redirect(route('home'));
        }else{
            return redirect(route('clientlogin'));
        }
    }

}