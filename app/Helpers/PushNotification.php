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

        'Authorization' => 'Bearer ya29.c.c0AY_VpZgaaINcE_eZv46zkd7leLCrZbM8cjZiqZnF3g-p7LtarLl5ejtuViLh6LS4tH7WOYSK39egT9r9FhLWCxpx3ufhpIWEE1kXDUQQZba0L0BTwAKvWsIRF5786H7IhRvY7fCNET5mp4qM9EliYLJSnRdy9o3gGQzD24U2WZozyS5TGqUWnvSa4Rm7ziaAqEdn0ctJ0IJhir5sxjXJLsCPJ7C_Hl8Ryaqz1raIbk6WabpveiVwslQ58iYCNbj2MWqADKohJBq3_d94pwDLxpqD_X9JbotMDq5GO17IgvMlHqSdbXYw8hnGbMErHSIoiRFtCL-CG1eNMyImnlqHH-6LdeA2Zm-7QiC4pteOPdxANB8Ns5-e4c0E384ARh5xiFJlq4bYZ-8l0mI4ZYBJ4Vyihh2nu_l0kp_35Y4ll_5k8sUfkaV8-bfyjvbSe7dUkOWrJS-uyjd8Bgcc8qRbRlkf6c8IVm97O7WF0b5taqQ9n14SY6ur2ZZOeb2od242omBQMgfsgh9qrja-U9iSVarzwxtBlxiB778Ud-bW670SuBOQjxBwrjWyIjnt4JejrV-l5xrcs76zm58xhccIctogF5xr937r30U9OUgBirRlZakouufha_WVeifdS2rrf3cb6IbR12-B_dau6-fWIOoxa6vOrr3txquV1ScwpQ_2wUc2XynmzIFFzg2VU22gQ8z0t1-jzonv0a8yYduq4si8VZW5nIJ6-4g_l32WMI63S0vZQZrF3tnjtQ_MMubQmlt3k_z3Yz2xgM1UsjxWcQ43lzqYsZ5IFn65b2-pcfUaxta4IJfYFFrrpgQV4-bmdq97UJ7qp7lrvsQ3-6s6iibxt_t8XIbI58WU213zuSzvRI29RIfFBhQzqB3dffSmUhwQOxh4yeMWinhz9t0crk43_aXw84rZn8FtvnXJ2IxV-bdXc66OS7e5cFUYxVqF_BlOJX1StfgJ7UjcFB7ut22O_qU68mnj4Zc6Is',
        'Content-Type' => 'application/json',

    ])->post($url, $details);

   // dd($response);

    return $response;
}