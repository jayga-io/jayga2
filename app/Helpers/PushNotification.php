<?php

function send_notif($data){
   // dd($data);
    $url = "https://fcm.googleapis.com/v1/projects/jayga-fa1ad/messages:send";
    $details = [
        'message' => [
            'token' => $data,
            'notification' => [
                'title' => 'New Notification',
                'body' => 'This is a test notification',
            ]
        ]
    ];
            
 

   // dd($details);

   
    $response = Http::withHeaders([

        'Authorization' => 'Bearer ya29.c.c0AY_VpZjlmP9B831FTd7W7UsgRaqp79iZ3JD1UCb5tz-OsI1i-f-v6DWanNbYESbr4_JJF6JmN1X78FWlvYg25swdGZBebe8sKHR_5FO26IlLmnVQCp2N1Gn8W6oaWllIKvNczJnyJrtPNGXGZyZHMWqKX3xgZbiqiY4_8yFjt-j2WWAKkN9Hmi7qxBU2wq2Ybq5VlZqqXxVWgCeLc9IOTtSYQoevqiEMeE0A2Ujr18xo7Sq3X0XEUsF8YAxeldANmriyVYKTY6lrzoIXfy50rrE448M9NLZ6pnDEOgr7ONA-Zp8pKXtZJieFuaGgfmIsJ6Iel4e-V6mSQ7BRXvD0oVornzz16vMajvBJ9IqgzYI92KdKpZxo15AG384K4-kjzteaYIzc21pYzFs9b7yVVQUje3tsy0Mgxj34Vxcz01pm-22cJ8usrFYfn79xWVcm618wj9Ymg7YOOtn2lmqdXgtzqW22wcZ8YXyfjSW8qU6ZWtiivZgrpj6mwXYMw-w6sf_xv-OoW6cp04tI7z1c5qMpcqIM652nvkxd5UgRSybjv_OwJ0IbIOvx3f9415x3wcY1YoBavXIxfauJVOJwhJfqgjggwYIwg7cb1ZugSpmgi-ZR-Z7g08Rbc1zscXZ1etB_emQIVyugJMdeojwB-6pp2rvt0hJ3MM9ev_gzhbQxj0nZIzhnww5SrJrxI9plb-tsYOO34U5uejXbY1V5puSj95yz6pIrz8uWI47Q9gcR8iQgzzlga7v3UU5dipxlWgS-crgmFRejaiU9Iuv_X8q4VI_BzgUrOdhlbOo_JScxv5eWdh0yvp8s5oym6cY-Zt_6sY8k5F93OsOh0_F4zia-oVd6_tt0s3Job2RgjihxoF0rzUdj5zzxOvJxFnncMUFf-yyJsUhFttiR6VaM2MV_fspJJ_QSdz8X_uRFb_gW84M3U32oevnou_JcZno10vYdIUq9wiFIW36YvtYXoqmuQoYxZ66w0Mc',
        'Content-Type' => 'application/json',

    ])->post($url, $details);

   // dd($response);

    return $response;
}