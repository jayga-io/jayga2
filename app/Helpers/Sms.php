<?php 

            
function send_sms($data){
    $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
    $response = Http::withHeaders([
        'Authorization' => 'Token d275d614a4ca92e21d2dea7a1e2bb81fbfac1eb0',
        
    ])->post($url, $data);

    return $response;
}

?>