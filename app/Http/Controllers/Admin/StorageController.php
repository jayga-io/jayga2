<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdditionalStorageServices;
use App\Models\InventoryType;
use App\Models\Inventory;

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

    public function show_inventory_requests(Request $request){
        $pendinginventories = Inventory::where('status', false)->with('user')->with('business_location')->get();
        
        return view('admin.storage.storagerequests')->with('pendinginventories', $pendinginventories);
    }

    public function inventories(Request $request){
        $acceptedinventories = Inventory::where('status', true)->with('user')->with('business_location')->get();
        return view('admin.storage.inventories')->with('acceptedinventories', $acceptedinventories);
    }

    public function delete_inventory_types(Request $request, $id){
        InventoryType::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Inventory type deleted');
    }

    public function delete_additional_service(Request $request, $id){
        AdditionalStorageServices::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Additional service deleted');
    }

    public function delete_inventories(Request $request, $id){
        Inventory::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Inventory request deleted');
    }
}
