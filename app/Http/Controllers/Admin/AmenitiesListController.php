<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AmenitiesList;
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
        $data = [
            'amenities_name' => $request->input('amenity_name'),
            'amenities_icon' => $file->hashName(),
            'amenities_category' => $request->input('amenities_category')
        ];

        amenities($data);
        return redirect()->back()->with('success', 'Amenities Added Successfully.');
    }

    public function delete(Request $request, $id){
        AmenitiesList::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Amenities Deleted');
    }
}
