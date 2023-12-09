<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListerDashboard;
use App\Models\BankDetails;
use App\Models\Withdraws;
use App\Models\User;

class AccountsController extends Controller
{
    public function accounts(Request $request){
        $user = $request->session()->get('user');
        $details = ListerDashboard::where('lister_id', $user)->get();
        $bank = BankDetails::where('user_id', $user)->get();
        return view('host.accounts.dash')->with('details', $details)->with('bank', $bank);
    }

    public function withdraw(Request $request){
        $user = $request->session()->get('user');
        $details = ListerDashboard::where('lister_id', $user)->get();
        return view('host.accounts.withdraw')->with('balance', $details);
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
            toastr()->addSuccess('Withdraw requested');
            return redirect()->back()->with('success', 'Withdrawal usually takes 48 hours to process. please be patient');
        }
    }
}
