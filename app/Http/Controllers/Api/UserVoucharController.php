<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vouchar;
use App\Models\UserVouchar;
use App\Models\Booking;
use App\Models\Listing;
use Carbon\Carbon;

class UserVoucharController extends Controller
{
    //user vouchar add
    public function add_vouchar_user(Request $request){
        $validated = $request->validate([
            'vouchar_code' => 'required',
            'user_id' => 'required',
        ]);

        if($validated){
            $today = Carbon::today();
            $vouchar = Vouchar::where('vouchar_code', $request->input('vouchar_code'))->where('validity_end', '>=', $today)->get();
            if(count($vouchar)>0){
                $usage = Booking::where('vouchar_code', $request->input('vouchar_code'))->where('user_id', $request->input('user_id'))->count();
                if($usage > 1){
                    return response()->json([
                        'status' => 403,
                        'messege' => 'maximum usage amount for the vouchar for this user reached'
                    ], 403);
                }else{
                    UserVouchar::create([
                        'user_id' => $request->input('user_id'),
                        'vouchar_id' => $vouchar[0]->id,
                        'vouchar_code' => $vouchar[0]->vouchar_code,
                        'discount_type' => $vouchar[0]->discount_type,
                        'discount_value' => $vouchar[0]->discount_value,
                        'max_discount' => $vouchar[0]->max_discount,
                        'validity_start' => $vouchar[0]->validity_start,
                        'validity_end' => $vouchar[0]->validity_end,
                        'usage_count' => 0,
                        'created_on' => $vouchar[0]->created_on,
                    ]);

                    return response()->json([
                        'status' => 200,
                        'messege' => 'Vouchar added to this user'
                    ]);
                }
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'Invalid Vouchar / Vouchar expired'
                ], 404);
            }
        }else{
            return $validated->errors();
        }
    }


    public function get_vouchar(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
        ]);

        if($validated){
            $vouchars = UserVouchar::where('user_id', $request->input('user_id'))->with('users')->with('vouchars')->get();
            if(count($vouchars)>0){
                return response()->json([
                    'status' => 200,
                    'vouchars' => $vouchars
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'Vouchar expired'
                ], 404);
            }
            
        }else{
            return $validated->errors();
        }
    }

    public function user_valid_vouchars(Request $request){
        $validated = $request->validate([
            'total_amount' => 'required',
            'user_id' => 'required',
            'listing_id' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
        ]);

        if($validated){
           $listing = Listing::where('listing_id', $request->input('listing_id'))->get();
            $date1 = Carbon::createFromFormat('Y-m-d', $request->input('checkin'));
            $date2 = Carbon::createFromFormat('Y-m-d', $request->input('checkout'));

            $daysDifference = $date1->diffInDays($date2);

            $vouchers = UserVouchar::where('user_id', $request->input('user_id'))->get();
            $applicableVouchers = [];

            if(count($vouchers)>0){
                foreach ($vouchers as $voucher) {
                
                    if ($voucher->discount_value >= 50 && $voucher->discount_type == '%' && $voucher->usage_count == 0 && $daysDifference >= 3) {
                        $newPayamount = ($request->input('total_amount')*($voucher->discount_value)/100);
                        $deductedAmount = 0;
                        if($newPayamount > $voucher->max_discount){
                            $deductedAmount = $request->input('total_amount') - $voucher->max_discount;
                        }else{
                            $deductedAmount = $request->input('total_amount') - $newPayamount;
                        }
                        
                        $calculation = [
                            'vouchar' => $voucher,
                            'total_amount' => $request->input('total_amount'),
                            'discounted_price' => $deductedAmount,
                            'deducted_price' => $voucher->max_discount
                        ];
                        array_push($applicableVouchers, $calculation);
                    }
        
                    if ($voucher->discount_value <= 200 && $voucher->discount_type == 'TK' && $voucher->usage_count == 0 && $listing[0]->listing_type == 'apartment') {
                        $newPaid = $request->input('total_amount') - $voucher->max_discount;
                        $calculation = [
                            'vouchar' => $voucher,
                            'total_amount' => $request->input('total_amount'),
                            'discounted_price' => $newPaid,
                            'deducted_price' => $voucher->max_discount
                        ];
                        array_push($applicableVouchers, $calculation);
                    }
        
                }

                if(count($applicableVouchers) > 0){
                    return response()->json([
                        'status' => 200,
                        'vouchars' => $applicableVouchers
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'messege' => 'No applicable vouchars found'
                    ], 404);
                }
                
            }else{
                return response()->json([
                    'status' => 404,
                    'messege' => 'No vouchars found'
                ], 404);
            }
            
        }else{
            return $validated->errors();
        }
    }
}