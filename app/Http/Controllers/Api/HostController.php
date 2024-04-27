<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankDetails;
use App\Models\Withdraws;

class HostController extends Controller
{
    //bank add
    public function add_bank(Request $request){
        $validated = $request->validate([
            'lister_id' => 'required',
            'acc_name' => 'required',
            'acc_number' => 'required',
            'bank_name' => 'required',
            'routing_number' => 'required',
            'branch_name' => 'required',
            'type' => 'required',
        ]);
        if($validated){
           $checkBank = BankDetails::where('acc_number', $request->input('acc_number'))->where('lister_id', $request->input('lister_id'))->get();
           if(count($checkBank)>0){
                BankDetails::where('lister_id', $request->input('lister_id'))->update([
                    'lister_id' => $request->input('lister_id'),
                    'acc_name' => $request->input('acc_name'),
                    'acc_number' => $request->input('acc_number'),
                    'bank_name' => $request->input('bank_name'),
                    'routing_number' => $request->input('routing_number'),
                    'type' => $request->input('type'),
                    'branch_name' => $request->input('branch_name'),
                ]);
           }else{
                BankDetails::create([
                    'lister_id' => $request->input('lister_id'),
                    'acc_name' => $request->input('acc_name'),
                    'acc_number' => $request->input('acc_number'),
                    'bank_name' => $request->input('bank_name'),
                    'routing_number' => $request->input('routing_number'),
                    'type' => $request->input('type'),
                    'branch_name' => $request->input('branch_name'),
                ]);
           }
           
            
            return response()->json([
                'status' => 200,
                'message' => 'Bank details added successfully'
            ]);
        }else{
            return $validated->errors();
        }
    }

    //get bank
    public function get_bank(Request $request){
        $validated = $request->validate([
            'lister_id' => 'required',
        ]);

        if($validated){
            $bank = BankDetails::where('lister_id', $request->query('lister_id'))->get();
            if(count($bank)>0){
                return response()->json([
                    'status' => 200,
                    'bank_details' => $bank
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'bank_details' => 'No details found'
                ], 404);
            }
        }else{
            return $validated->errors();
        }
    }

    //withdraw history
    public function withdraw_history(Request $request){
        $validated = $request->validate([
            'lister_id' => 'required',
        ]);

        if($validated){
            $wh = Withdraws::where('user_id', $request->query('lister_id'))->get();
            if(count($wh)>0){
                return response()->json([
                    'status' => 200,
                    'withdraws' => $wh
                ]);
            }else{
                return response()->json([
                    'status' => 404,
                    'withdraws' => 'No withdrawal history found'
                ], 404);
            }
        }
    }

    //delete bank
    public function delBank(Request $request){
        $valid = $request->validate([
            'bank_id' => 'required',
        ]);

        if($valid){
            BankDetails::where('id', $request->query('bank_id'))->delete();

            return response()->json([
                'status' => 200,
                'messege' => 'Bank Details Removed'
            ]);
        }else{
            return $valid->errors();
        }
        
    }

    public function update_bank(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'bank_id' => 'required'
        ]);

        if($validated){
            BankDetails::where('lister_id', $request->input('user_id'))->where('id', $request->input('bank_id'))->update($request->all());

            return response()->json([
                'status' => 200,
                'messege' => 'Bank Details updated'
            ]);
        }else{
            return $validated->errors();
        }
    }
}
