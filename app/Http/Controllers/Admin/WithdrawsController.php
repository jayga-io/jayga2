<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraws;
use App\Models\TransactionHistory;

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
        toastr()->addSuccess('Payment completed');
        return redirect()->back();
    }
}
