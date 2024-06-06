<?php

function send_notif($data){
   // dd($data);
    $url = "https://fcm.googleapis.com/fcm/send";
    $details = [
        'to' => $data,
        'notification' => [
            'title' => 'title',
            'body' => 'body'
        ],
    ];
               

   // dd($details);

   
    $response = Http::withHeaders([

        'Authorization' => 'key=AAAAeOE4nqg:APA91bGSkxDP4cmqLb5supVEbHVmQBUIHH1NeKJsPkiGXTqPrGJmHxH6GRok8wgwUf7T8n_YBUmyzgqirs6Be1rI5nVO1hizAjBDQPImT7DvFG2Cln0xQW4xe6tZmqYWA8zJnwJIIhM6',
        'Content-Type' => 'application/json',

    ])->post($url, $details);

   // dd($response);

    return $response;
}