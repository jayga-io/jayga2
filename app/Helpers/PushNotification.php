<?php

function send_notif($data){
    $url = "https://fcm.googleapis.com/v1/projects/jayga-fa1ad/messages:send";
    $details = [
        
            "message" => [
                "token" => $data['token'],
                "notification" => [
                    "body" => "This is an FCM notification message!",
                    "title" => "FCM Message"
                ]
                    
                  
            ]
               
              
            
         
    ];

    $response = Http::withHeaders([
        'Authorization' => 'Bearer AAAAeOE4nqg:APA91bGSkxDP4cmqLb5supVEbHVmQBUIHH1NeKJsPkiGXTqPrGJmHxH6GRok8wgwUf7T8n_YBUmyzgqirs6Be1rI5nVO1hizAjBDQPImT7DvFG2Cln0xQW4xe6tZmqYWA8zJnwJIIhM6',
    ])->post($url, $details);

    return $response;
}