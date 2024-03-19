<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refunds;
use App\Models\Booking;
use App\Models\BookingHistory;

class RefundsController extends Controller
{
    public function show_refunds(Request $request){
        $rf = Refunds::with('user')->with('listing')->get();
        return view('admin.refunds.refunds')->with('refunds', $rf);
    }

    public function paid(Request $request, $id){
        Refunds::where('id', $id)->update([
            'isPaid' => true
        ]);
        $book = Refunds::where('id', $id)->get();
        BookingHistory::where('booking_id', $book[0]->booking_id)->update([
            'booking_status' => 5
        ]);
        return redirect()->back()->with('success', 'Refund cleared');
    }

    public function delete(Request $request, $id){
        Refunds::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Refund request deleted');
    }
}
