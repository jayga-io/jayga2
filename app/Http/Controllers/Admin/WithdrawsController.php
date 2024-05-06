<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraws;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class WithdrawsController extends Controller
{
    public function show(Request $request){
        $withdraws =  Withdraws::where('status', false)->get();
        return view('admin.withdraws.withdraw')->with('withdraws', $withdraws);
    }

    public function mark_paid(Request $request, $id){
        $amount = Withdraws::where('id', $id)->get();
        Withdraws::where('id', $id)->update([
            'status' => true
        ]);
        TransactionHistory::where('transaction_amount', $amount[0]->withdraw_amount)->update([
            'status' => true
        ]);

        $receipent = $amount[0]->email;
        $subject = 'Withdraw Request Processed';
       // $time = date("Y-m-d H:i:s");
        
       // $destinationaccount = $;
         Mail::plain(
            view: 'mailTemplates.withdrawprocess',
            data: [
                'lister' => $amount[0]->user_name,
                'withdraw_date' => $amount[0]->created_on,
                'withdraw_amount' => $amount[0]->withdraw_amount,
                'destinationaccount' => $amount[0]->acc_number,
                
            ],
            callback: function (Message $message) use ($receipent, $subject) {
                $message->to($receipent)->subject($subject);
            }
        );

        toastr()->addSuccess('Payment completed');
        return redirect()->back();
    }
}
