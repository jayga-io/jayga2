<?php

namespace App\Http\Controllers\Api\email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListingEmail extends Controller
{
    public function send_listing_email(Request $request){
        $validated = $request->validate([
            'listing_id' => 'required'
        ]);

        if($validated){
            $listing = Listing::where('listing_id', $request->input('listing_id'))->with('host')->get();
            if(count($listing)>0){
                $receipent = $listing[0]->host->email;
                $subject = 'Listing Creation Under Review';

                 Mail::plain(
                    view: 'mailTemplates.ListingCreation',
                    data: [
                        'username' => $listing[0]->host->name,
                        'listing_title' => $listing[0]->listing_title
                    ],
                    callback: function (Message $message) use ($receipent, $subject) {
                        $message->to($receipent)->subject($subject);
                    }
                );
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No listing found'
                ], 404);
            }
        }else{
            return $validated->errors();
        }
    }
}
