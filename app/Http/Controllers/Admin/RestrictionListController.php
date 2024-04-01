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
         
         RestrictionList::create([
            'restriction_name' => $request->input('restriction_name'),
            'restriction_icon' => $path,
         ]);
         return redirect()->back()->with('success', 'Restrictions Added Successfully.');
     }

    public function delete(Request $request, $id){
        RestrictionList::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Restrictions Deleted');
    }

    public function update_restriction(Request $request){
        // dd($request->all());
 
        if($request->hasFile('restriction_icon')){
 
             $file = $request->file('restriction_icon');
             $path = $file->store('restrictions');

             RestrictionList::where('id', $request->input('restriction_id'))->update([
                'restriction_name' => $request->input('restriction_name'),
                'restriction_icon' => $path,
             ]);
 
            
             
        }else{
            RestrictionList::where('id', $request->input('restriction_id'))->update([
                'restriction_name' => $request->input('restriction_name'),
                
             ]);
        }
 
        return redirect()->back()->with('success', 'Restriction Updated');
     }
}
