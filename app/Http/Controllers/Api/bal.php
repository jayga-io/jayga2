            
           

            if($daysDifference >= 3){
                $vouchars = UserVouchar::where('user_id', $request->input('user_id'))->get();
                $validVouchars = Vouchar::whereIn('id', $vouchars[0]->vouchar_id);
                dd($validVouchars);
                $newPayamount = ($request->input('total_amount')*($value->vouchars[0]->discount_value)/100);
                $deductedAmount = $request->input('total_amount') - $newPayamount;
                return response()->json([
                    'status' => 200,
                    'total_amount' => $request->input('total_amount'),
                    'valid vouchar' => [
                        'vouchar_code' => $value->vouchars[0]->vouchar_code,
                        'discounted_amount' => $newPayamount,
                        'price_after_discount' => $deductedAmount,
                    ]
                ]);
            }else{
                return response()->json([
                    'status' => 405,
                    'messege' => 'percentage vouchars applicable for at least 3 days of booking'
                ], 405);
            }


            if($listing[0]->listing_type == 'apartment'){
                $newPaid = $request->input('pay_amount') - $vouchar[0]->vouchars[0]->discount_value;
                return response()->json([
                    'status' => 200,
                    'total_amount' => $request->input('total_amount'),
                    'valid vouchar' => [
                        'vouchar_code' => $value->vouchars[0]->vouchar_code,
                        'discounted_amount' => $value->vouchars[0]->discount_value,
                        'price_after_discount' => $newPaid,
                    ]
                ]);
            }else{
                return response()->json([
                    'status' => 405,
                    'messege' => 'solid vouchars are applicable to apartment bookings only'
                ], 405);
            }


