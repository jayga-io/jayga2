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
            
        }elseif(preg_match($pattern, $logindetail)){
           // dd('Email Valid');
           $to_email = $request->input('txt');
            $subject = 'Jayga OTP';
            $message = 'Your OTP for Jayga is: '. $otp;

            // Send email
            Mail::raw($message, function($message) use ($to_email, $subject) {
                $message->to($to_email)->subject($subject);
            });
             
        }else{
            return redirect()->back()->with('error', 'Invalid email');
        }
        
        session([
            'otp' => $otp,
            'login' => $logindetail,
        ]); 

    
        return view('client.otp')->with('code', $otp);
    }


    public function verify(Request $request){
        $code = $request->input('OTP');
        $session = $request->session()->get('otp');
        $auth = $request->session()->get('login');
        $pattern = '/^\S+@\S+\.\S+$/';
        if($code == $session){
            $user = User::where('phone', $auth)->orWhere('email', $auth)->get();
           
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

                    if(is_numeric($auth)){
                       
                        User::create([
                            'phone' => $auth
                        ]);
                    
                    }elseif(preg_match($pattern, $auth)){
                        
                        User::create([
                            'email' => $auth
                        ]);
                    }

            $id = User::where('phone', $auth)->orWhere('email', $auth)->get();
           
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
