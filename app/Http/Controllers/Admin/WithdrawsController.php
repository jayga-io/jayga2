<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Withdraws;

class WithdrawsController extends Controller
{
    public function show(Request $request){
        $withdraws =  Withdraws::where('status', false)->get();
        return view('admin.withdraws.withdraw')->with('withdraws', $withdraws);
    }
}
