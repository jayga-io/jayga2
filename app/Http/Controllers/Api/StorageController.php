<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BusinessLocation;
use App\Models\Inventory;

class StorageController extends Controller
{
    public function send_storage_request(Request $request){
        $validated = $request->validate([
            'district' => 'required',
            'user_id' => 'required',
            'primary_address' => 'required',
            'business_storage_size' => 'required',
            'inventories' => 'required|array',
            'inventories.item_name' => 'required',
            'inventories.quantity_type' => 'required',
            'inventories.quantity_value' => 'required',
            'inventories.item_type' => 'required',
            
            
            
        ]);
    
       // dd($validated);
        if($validated){
           // $user = User::where('id', $request->input('user_id'))->with('avatars')->get();
           BusinessLocation::create([
            'user_id' => $request->input('user_id'),
            'district' => $request->input('district'),
            'primary_address' => $request->input('primary_address'),
            'additional_address' => $request->input('additional_address'),
            'business_storage_size' => $request->input('business_storage_size'),
            'additional_services' => $request->input('additional_services'),
            'created_on' => date('Y-m-d H:i:s')
           ]);

           $bl = BusinessLocation::latest()->first();
          
            $inventories[] = $request->input('inventories');

            

            foreach ($inventories as $key => $value) {
               Inventory::create([
                'user_id' => $request->input('user_id'),
                'business_location_id' => $bl->business_id,
                'item_name' => $value['item_name'],
                'quantity_type' => $value['quantity_type'],
                'quantity_value' => $value['quantity_value'],
                'item_type' => $value['item_type'],
                
                'additional_details' => $value['additional_details'],
               // 'additional_services' => $value['additional_services'],
                'created_on' => date('Y-m-d H:i:s')
               ]);
            }
            

            return response()->json([
                'status' => 200,
                'messege' => 'Inventory Request Sent'
            ]);
            
        }else{
            
            return $validated->errors();
        }

    }
}
