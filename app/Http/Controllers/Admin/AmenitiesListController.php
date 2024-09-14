<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AmenitiesList;
//use App\Helpers\Amenities;
use Storage;


class AmenitiesListController extends Controller
{
    public function index(){
        $amenties = AmenitiesList::all();
        return view('admin.amenities.amenities')->with('amenities', $amenties);
    }

    public function create(Request $request){
       // dd($request->input('fileupload'));
        $file = $request->file('fileupload');

        $path = $file->store('amenities');
       // dd($file);
       

        AmenitiesList::create([
            'amenities_name' => $request->input('amenity_name'),
            'amenities_icon' => $path,
            'amenities_category' => $request->input('amenities_category'),
            'amenity_type' => $request->input('amenity_type')
        ]);
        return redirect()->back()->with('success', 'Amenities Added Successfully.');
    }

    public function delete(Request $request, $id){
        AmenitiesList::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Amenities Deleted');
    }

    public function update_amenity(Request $request){
       // dd($request->all());

       if($request->hasFile('amenity_icon')){

            $file = $request->file('amenity_icon');
            $path = $file->store('amenities');

            AmenitiesList::where('id', $request->input('amenity_id'))->update([
                'amenities_name' => $request->input('amenity_name'),
                'amenities_icon' => $path,
                'amenities_category' => $request->input('amenities_category'),
                'amenity_type' => $request->input('amenity_type')
            ]);
            
       }else{
        AmenitiesList::where('id', $request->input('amenity_id'))->update([
            'amenities_name' => $request->input('amenity_name'),
            
            'amenities_category' => $request->input('amenities_category'),
            'amenity_type' => $request->input('amenity_type')
        ]);
       }

       return redirect()->back()->with('success', 'Amenity Updated');
    }
}
