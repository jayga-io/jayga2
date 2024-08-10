<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdditionalStorageServices;
use App\Models\InventoryType;

class StorageController extends Controller
{
    //show additional services page on admin
    public function show_services(Request $request){
        $services = AdditionalStorageServices::all();
        return view('admin.storage.additionalservices')->with('services', $services);
    }

    public function create_services(Request $request){
        
        if($request->hasFile('service_icon')){
            $file = $request->file('service_icon');
            $file->store('storage');

            AdditionalStorageServices::create([
                'service_icon' => $file->hashName(),
                'service_name' => $request->input('service_name'),
                'service_description' => $request->input('service_description')
            ]);

            return redirect()->back()->with('success', 'Additional service added');
        }else{
            return redirect()->back()->with('error', 'Service icon is required');
        }
    }

    public function inventory_types(Request $request){
        $types = InventoryType::all();
        return view('admin.storage.inventorytypes')->with('types', $types);
    }

    public function create_inventory_type(Request $request){
        InventoryType::create([
            'inventory_type' => $request->input('inventory_type')
        ]);

        return redirect()->back()->with('success', 'Inventory type added');
    }
}
