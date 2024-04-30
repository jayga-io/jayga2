<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refunds;
use Illuminate\Support\Str;

class RefundsController extends Controller
{
    public function claim_refund(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'lister_id' => 'required',
            'listing_id' => 'required',
            'booking_id' => 'required',
            'refund_amount' => 'required',
        ]);

        if($validated){
           
            Refunds::create([
                'user_id' => $request->input('user_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'booking_id' => $request->input('booking_id'),
                'refund_amount' => $request->input('refund_amount'),
                'bank_name' => $request->input('bank_name'),
                'acc_name' => $request->input('acc_name'),
                'acc_number' => $request->input('acc_number'),
                'branch_name' => $request->input('branch_name'),
                'routing_num' => $request->input('routing_num'),
                'messege' => $request->input('messege'),
                'type' => Str::lower($request->input('type')),
               ]);

               
               $notifys = [
                'user_id' => $request->input('user_id'),
                'lister_id' => $request->input('lister_id'),
                'listing_id' => $request->input('listing_id'),
                'booking_id' => $request->input('booking_id'),
                'type' => 'Refund Processed: '.$request->input('booking_id'),
                'messege' => 'Your refund for booking '.$request->input('booking_id').' has been successfully processed. You should see the refund reflected in your account shortly.',
                'created_on' => date('Y-m-d H:i:s')
            ];
        
               notify($notifys);

               return response()->json([
                    'status' => 200,
                    'messege' => 'Refund Request Submitted'
               ]);
        }else{
            return $validated->errors();
        }
    }
}
