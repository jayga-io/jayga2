<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListerDashboard;
use App\Models\BankDetails;
use App\Models\Withdraws;
use App\Models\User;
use App\Models\TransactionHistory;

class AccountsController extends Controller
{
    public function accounts(Request $request){
        $user_id = $request->session()->get('user');
        $details = ListerDashboard::where('lister_id', $user_id)->get();
        $bank = BankDetails::where('lister_id', $user_id)->get();
        $user = User::where('id', $user_id)->get();
        $tran_history = TransactionHistory::where('user_id', $user_id)->get();
        return view('host.accounts.dash')->with('details', $details)->with('bank', $bank)->with('user', $user)->with('history', $tran_history);
    }

    public function withdraw(Request $request){
        $user = $request->session()->get('user');
        $details = ListerDashboard::where('lister_id', $user)->get();
        $bank = BankDetails::where('lister_id', $user)->get();
        return view('host.accounts.withdraw')->with('balance', $details)->with('bank', $bank);
    }

    public function withdraw_request(Request $request){
        
        $id = $request->session()->get('user');
        $user = User::where('id', $id)->get();
        $lister = ListerDashboard::where('lister_id', $id)->get();
        $amount = $request->input('withdraw');
        if($amount > $lister[0]->earnings){
            
            toastr()->addError('Withdraw amount invalid');
            return redirect()->back();
        }else{
            Withdraws::create([
                'user_id' => $id,
                'user_name' => $user[0]->name,
                'phone' => $user[0]->phone,
                'user_balance' => $lister[0]->earnings,
                'withdraw_amount' => $amount
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
                'bank_id' => $request->input('bank_id'),
                'account_name' => $request->input('acc_name'),
                'acc_number' => $request->input('acc_number'),
                'bank_name' => $request->input('bank_name'),
                'branch_name' => $request->input('branch_name'),
            ]);
            toastr()->addSuccess('Withdraw requested');
            return redirect()->back()->with('Notice', 'Withdrawal usually takes 48 hours to process. please be patient');
        }
    }
}
