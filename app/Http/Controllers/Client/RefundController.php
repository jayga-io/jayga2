<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refunds;

class RefundController extends Controller
{
    public function refund_submit(Request $request){
       // dd($request->all());
       Refunds::create([
        'user_id' => $request->input('user_id'),
        'lister_id' => $request->input('lister_id'),
        'listing_id' => $request->input('listing_id'),
        'booking_id' => $request->input('booking_id'),
        'refund_amount' => $request->input('refund_amount'),
        'bkash' => $request->input('bkash_num'),
        'acc_name' => $request->input('acc_name'),
        'acc_number' => $request->input('acc_number'),
        'branch_name' => $request->input('branch_name'),
        'routing_num' => $request->input('routing_num'),
        'messege' => $request->input('messege'),
       ]);

       return redirect()->back()->with('success', 'Refund request submitted');
    }
}
