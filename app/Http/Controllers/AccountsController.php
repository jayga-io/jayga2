<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListerDashboard;
use App\Models\BankDetails;

class AccountsController extends Controller
{
    public function accounts(Request $request){
        $user = $request->session()->get('user');
        $details = ListerDashboard::where('lister_id', $user)->get();
        $bank = BankDetails::where('user_id', $user)->get();
        return view('host.accounts.dash')->with('details', $details)->with('bank', $bank);
    }
}
