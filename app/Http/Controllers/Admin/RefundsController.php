<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refunds;
use App\Models\Booking;
use App\Models\BookingHistory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class RefundsController extends Controller
{
    public function show_refunds(Request $request){
        $rf = Refunds::orderBy('created_at', 'DESC')->with('user')->with('listing')->get();
        return view('admin.refunds.refunds')->with('refunds', $rf);
    }

    public function paid(Request $request, $id){
        Refunds::where('id', $id)->update([
            'isPaid' => true
        ]);
        $book = Refunds::where('id', $id)->with('user')->with('listing')->get();
        
        BookingHistory::where('booking_id', $book[0]->booking_id)->update([
            'booking_status' => 5
        ]);
       

        $receipent = $book[0]->user->email;
        $subject = 'Jayga Refund Processed';

         Mail::plain(
            view: 'mailTemplates.refundprocessed',
            data: [
                'user' => $book[0]->user->name,
                'listing_title' => $book[0]->listing->listing_title,
                'booking_id' => $book[0]->booking_id,
                'refund_amount' => $book[0]->refund_amount,
                'refund_date' => $book[0]->created_on,
            ],
            callback: function (Message $message) use ($receipent, $subject) {
                $message->to($receipent)->subject($subject);
            }
        );

        return redirect()->back()->with('success', 'Refund cleared');
    }

    public function delete(Request $request, $id){
        Refunds::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Refund request deleted');
    }
}
