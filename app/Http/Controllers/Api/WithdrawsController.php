<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListerDashboard;
use App\Models\BankDetails;
use App\Models\Withdraws;
use App\Models\User;
use App\Models\TransactionHistory;

class WithdrawsController extends Controller
{
    public function postRequest(Request $request){
        $validated = $request->validate([
           'lister_id' => 'required',
           'amount' => 'required'
        ]);

        if($validated){
            $id = $request->input('lister_id');
            $amount = $request->input('amount');
            $user = User::where('id', $request->input('lister_id'))->get();
            $bank = BankDetails::where('lister_id', $request->input('lister_id'))->get();
            $lister = ListerDashboard::where('lister_id', $request->input('lister_id'))->get();
            Withdraws::create([
                'user_id' => $request->input('lister_id'),
                'user_name' => $user[0]->name,
                'phone' => $user[0]->phone,
                'email' => $user[0]->email,
                'bank_name' => $bank[0]->bank_name,
                'acc_name' => $bank[0]->acc_name,
                'acc_number' => $bank[0]->acc_number,
                'routing_num' => $bank[0]->routing_number,
                'branch_name' => $bank[0]->branch_name,
                'user_balance' => $lister[0]->earnings,
                'withdraw_amount' => $request->input('amount'),
                'created_on' => date('Y-m-d H:i:s')
            ]);

            $remaining = $lister[0]->earnings - $amount;
            $withdrawn = $lister[0]->withdraws + $amount;
            
            ListerDashboard::where('lister_id', $id)->update([
                'earnings' => $remaining,
                'withdraws' => $withdrawn
            ]);

            TransactionHistory::create([
                'user_id' => $id,
                'transaction_amount' => $amount,
                'bank_id' => $bank[0]->id,
                'account_name' => $bank[0]->acc_name,
                'acc_number' => $bank[0]->acc_number,
                'bank_name' => $bank[0]->bank_name,
                'branch_name' => $bank[0]->branch_name,
                'created_on' => date('Y-m-d H:i:s')
            ]);

            $notifys = [
                'user_id' => $request->input('lister_id'),
                'lister_id' => $request->input('lister_id'),
                
                'type' => 'Withdrawal Processed : '.$request->input('amount'),
                'messege' => 'Your withdrawal request for '.$request->input('amount').' has been successfully processed. You should see the funds reflected in your account shortly.'
            ];
        
               notify($notifys);

            return response()->json([
                'status' => 200,
                'messege' => 'Withdraw Request Submitted'
            ]);

        }else{
            return $validated->errors();
        }
    }

    
}
