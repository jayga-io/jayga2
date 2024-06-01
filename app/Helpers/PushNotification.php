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
        'Authorization' => 'Bearer ya29.a0AXooCgtKmcrEbhovMnPAZZ6v2kcEqoBC43NTQovyTt-huLWz5cZNLu4WWtC4MySDjNg-92-FwzBziqc30O7AJEH_nYhctLAlny989nlwvJLDVhJ36O-OEdpGWnogAicqf2zXDTzrtU7DsV7J5FApsh-aGjcGGNp2c5OsaCgYKAfQSARESFQHGX2Mi6LCWG5B-o8qxKsvoIVghCg0171',
    ])->post($url, $details);

    dd($response);

    return $response;
}