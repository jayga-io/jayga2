<?php

function send_notif($data){
   // dd($data);
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

        'Authorization' => 'Bearer ya29.c.c0AY_VpZhkKM8O-lN18au4bp5gLq9FckOt1mTr-Z7HK_zpUxQobgVv2x5xxj-aHcPZZTGyvWy8Hv98pNV9WYgzes_KP5pSwpq95vrb604RC_V4DpoURTQ6I0y7HG8FwZ7DC9tr9bBJhQ4Dszrb00AhAQT-wFxvg9yRAtD4V9cjoYhkS-ssgdRvDFZHgklat3zReC-IaKh9EoI5YlvFRaKH-myPeDwaB1-ZQtUvye0PhfpEPBHoz6DzLtIuZHlkFYl4uM9Ywg00BdPOhlR4BlMx79gFXTvB_soCpJ9zJ5oSQrz6cL-2PyWfw51ZapYmWlVRmUYvLABIjtzXCVjKp0o0a3pgcd_lF1Qhfo3G8lbJ3DzcInG9LDiRTAL383AijsofOr48aqVzuo5MvmuBIcg3V1Xa4zjov23wcR6hBzVpc--fXsxbUIrd9Oflfh8e10mI4_wI7s0skuJVSoI_MjtUmS3MX1Xx5bRQepi_ROXUZfusrZku581rJ9YxOhJIuRM0Fsy1tv2tYWf_edhrSut_Zogpualx4Ozas1wxIR-nn6qp3OwWRo6gOdBxq7kp7gOrVm5qRpFFQjBzmb9hRkQe48_h0WWWavr-UnIWh4cw6WW7zYzy9e1Zh-om9xr9cwQt3v1YVpJsFjljvZYxm7b9ngm90bvrS8fB5dub9qF2JasqrcUMBbfIW22aJ4hqbQweFgx9Jox31cvWZrSZv9zv31brrB8B4o4UkeJ9bnYukgjkUpwIOz-dI1pt-fUhVQmQqZ-nIZJ8maqRVbZI5c6ozsqM85tj0vl1yJfRWm_44asc21kwtV6ZYpOW93u2RxxYwbr64UugVJ9RI335swgsxIvk_22otehh78IU91cssVW4ujV6sBX70vf6ZUuvl-SR6yyrBJRzZrySZ8B-bOm6alrqkqh9iuidmlp8eWFpkfkY1g7i1efXVWlpp5UJyMoinz-5sUBZInQIU9OQ_y9rF1z861YWSu4FlyfF9a',
        'Content-Type' => 'application/json',

    ])->post($url, $details);

   // dd($response);

    return $response;
}