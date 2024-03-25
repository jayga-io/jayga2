<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestrictionList;

class RestrictionListController extends Controller
{
    public function index(){
        $restricts = RestrictionList::all();
        return view('admin.restrictions.restrictions')->with('restrictions', $restricts);
    }

    public function create(Request $request){
        // dd($request->input('fileupload'));
         $file = $request->file('fileupload');
 
         $path = $file->store('restrictions');
        // dd($file);
         $data = [
             'restriction_name' => $request->input('restriction_name'),
             'restriction_icon' => $file->hashName(),
         ];
 
         restrictions($data);
         return redirect()->back()->with('success', 'Restrictions Added Successfully.');
     }

     public function delete(Request $request, $id){
        RestrictionList::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Restrictions Deleted');
    }
}
