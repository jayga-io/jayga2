<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vouchar;

class VoucharController extends Controller
{
    public function get_all(Request $request){
        $vouchars = Vouchar::all();
        return view('admin.vouchars.addvouchars')->with('vouchars', $vouchars);
    }

    public function create_new(Request $request){
        Vouchar::create([
            'vouchar_code' => $request->input('vouchar_code'),
            'discount_type' => $request->input('discount_type'),
            'discount_value' => $request->input('vouchar_value'),
            'validity_start' => $request->input('validity_start'),
            'validity_end' => $request->input('validity_end'),
            'min_days' => $request->input('duration'),
            'min_amount' => $request->input('minamount'),
            'max_discount' => $request->input('maxdiscount'),
            'created_on' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'vouchar created successfully');
    }

    public function delete_vouchar(Request $request, $id){
        Vouchar::where('id', $id)->delete();
        return redirect()->back()->with('error', 'Vouchar deleted');
    }
}
