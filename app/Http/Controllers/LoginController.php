<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use Illuminate\Http\Client\Pool;
use App\Models\User;
use App\Models\UserPictures;

class LoginController extends Controller
{
    public function login(){
        return view('client.login');
    }

    public function get_otp(Request $request){
        $otp = random_int(1000,9999);
            
       
          //  $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
            
          //  $user_api_url = env('APP_URL').'api/signin';
            $phone = $request->input('phone');
            $data = [
                "sender_id" => "8809601010510",
                "receiver" => $phone,
                "message" => "Your Jayga OTP is:".$otp,
                "remove_duplicate" => true
            ];

            send_sms($data);
          //  $response = Http::withHeaders([
          //      'Authorization' => 'Token d275d614a4ca92e21d2dea7a1e2bb81fbfac1eb0',
                
          //  ])->post($url, $data);

           /* $user = Http::post($user_api_url, [
               'phone' => $phone,
             ]);

            $body = $user->body();
            $decode = json_decode($body);
            $user_data = collect($decode);
             */
            session([
                'otp' => $otp,
                'phone' => $phone,
            ]); 

        
        return view('host.otp')->with('code', $otp);
    }

    public function otpverify(Request $request){
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
            
            return redirect(route('userdash'));
        }else{
            $request->session()->flush();
            return redirect('/host/login');
        }
    }

    public function host_setup(){
        return view('host.setup.host-setup');
    }
}
