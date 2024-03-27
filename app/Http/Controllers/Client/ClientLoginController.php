<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPictures;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;


class ClientLoginController extends Controller
{
    public function index(){
        return view('client.login');
    } 

    public function otp(Request $request){
       // dd($request->all());
        $otp = random_int(1000,9999);
        $logindetail = $request->input('txt');
        $pattern = '/^\S+@\S+\.\S+$/';

        if(is_numeric($logindetail)){
                $data = [
                    
                    "receiver" => $logindetail,
                    "message" => "Your Jayga OTP is:".$otp,
                    "remove_duplicate" => true
                ];

                send_sms($data);
            session([
                'otp' => $otp,
                'phone' => $logindetail,
            ]); 
        }elseif(preg_match($pattern, $logindetail)){
           // dd('Email Valid');
           Mail::raw('Hello world', function (Message $message) {
                $message->to('avoid.zoha@gmail.com')->from('mail@jayga.io');
            });
        }else{
            dd('Invalid email');
        }
        
       

    
        return view('client.otp')->with('code', $otp);
    }


    public function verify(Request $request){
        $code = $request->input('OTP');
        $session = $request->session()->get('otp');
        $phone = $request->session()->get('phone');
        if($code == $session){
            $user = User::where('phone', $phone)->get();
           
           if(count($user)>0){
            
            $photo = UserPictures::where('user_id', $user[0]->id)->get();
            if(count($photo)>0){
                session([
                    'user' => $user[0]->id,
                    'user_name' => $user[0]->name,
                    'user_email' => $user[0]->email,
                    'phone' => $user[0]->phone,
                    'photo' => $photo[0]->user_targetlocation,
                ]);
            }else{
                    session([ 
                    'user' => $user[0]->id,
                    'user_name' => $user[0]->name,
                    'phone' => $user[0]->phone,
                    'user_email' => $user[0]->email,
                    
                    ]);

                   // dd($request->session());
            }
            
           }else{
            User::create([
                'phone' => $phone
            ]);
            $id = User::where('phone', $phone)->get();
           
            session([ 
                'user' => $id[0]->id,
                'user_name' => $id[0]->name,
                'phone' => $id[0]->phone,
                'user_email' => $id[0]->email,
                
            ]);
           }
           // dd(session()->all());
            return redirect(route('home'));
        }else{
            $request->session()->flush();
            return redirect(route('clientlogin'));
        }
    }

}
