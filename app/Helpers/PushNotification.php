<?php

use App\Models\Firebase;

function send_notif($data){
    $firebase = Firebase::all();
   // dd($firebase[0]->server_key);
    $url = "https://fcm.googleapis.com/v1/projects/jayga-fa1ad/messages:send";
    $details = [
        'message' => [
            'token' => $data['token'],
            'notification' => [
                'title' => $data['title'],
                'body' => $data['body'],
            ]
        ]
    ];
            
 

   // dd($details);

   
    $response = Http::withHeaders([

        'Authorization' => 'Bearer '.$firebase[0]->server_key,
        'Content-Type' => 'application/json',

    ])->post($url, $details);

   // dd($response);

    return $response;
}