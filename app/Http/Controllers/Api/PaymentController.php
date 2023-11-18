<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function pay(Request $request){
        $validated = $request->validate([
            'booking_id' => 'required',
            'total_amount' => 'required',
            'tran_id' => 'required',
            'cus_email' => 'required',
            'cus_phone' =>'required',
           
        ]);
        if($validated){
            $book_id = $request->input('booking_id');
                $data = [
                'store_id' => 'jayga65056056e685d',
                'store_passwd' => 'jayga65056056e685d@ssl',
                'total_amount' => $request->input('total_amount'),
                'currency' => 'BDT',
                'tran_id' => $request->input('tran_id'),
                'product_category' => 'listing',
                'fail_url' => 'https://jayga.io/failed.html',
                'success_url' => 'https://jayga.io/success.html',
                'cancel_url' => 'https://jayga.io/failed.html',
                'cus_email' => $request->input('cus_email'),
                'cus_add1' => 'sgtgtetgw',
                'cus_city' => 'dvecaecec',
                'cus_country' => 'sevet',
                'cus_phone' => $request->input('cus_phone'),
                'shipping_method' => 'No',
                'product_name' => 'hello',
                'product_category' => 'hello',
                'product_profile' => 'general'

            ];


                $ch = curl_init('https://sandbox.sslcommerz.com/gwprocess/v4/api.php');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                // execute!
                $response = curl_exec($ch);

                // close the connection, release resources used
                curl_close($ch);

                $jsonresponse = json_decode($response, true);
                $payresponse = collect($jsonresponse);

                // do anything you want with your response
               // var_dump($response);
               return response()->json([
                'status' => 200,
                'booking_id' => $book_id,
                'response' => $payresponse
               ]);

        }else{
            return $validated->errors();
        }
        
    }

    public function paid(Request $request){
       $validated = $request->validate([
        'booking_id' => 'required',
        'pay_amount' => 'required',
        'lister_id' => 'required',
        'listing_id' => 'required',
       ]);
       if($validated){
        Booking::where('booking_id', $request->input('booking_id'))->update([
            'pay_amount' => $request->input('pay_amount'),
            'payment_flag' => true
        ]);
        

        $url = 'https://sysadmin.muthobarta.com/api/v1/send-sms';
            
        $number = User::where('id', $request->input('lister_id'))->get();
        $listing = Listing::where('listing_id', $request->input('listing_id'))->get();
        $phone = $user[0]->phone;
        $data = [
            "sender_id" => "8809601010510",
            "receiver" => $phone,
            "message" =>  $user[0]->name . ', Your listing: '. $listing[0]->listing_title . 'has a new booking placed',
            "remove_duplicate" => true
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Token d275d614a4ca92e21d2dea7a1e2bb81fbfac1eb0',
            
        ])->post($url, $data);


        return response()->json([
            'status' => 200,
            'messege' => 'Paid',
            'booking_id' => $request->input('booking_id'),
        ]);
       }else{
        return $validated->errors();
       }
    }
}
