<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListingReportCategories;
use App\Models\Reports;

class ListingReportCategoriesController extends Controller
{
    public function index(Request $request){
        $reports = ListingReportCategories::all();
        return view('admin.listingreports.addreports')->with('reports', $reports);
    }

    public function add_report_category(Request $request){
        ListingReportCategories::create([
            'category_name' => $request->input('category_name')
        ]);

        return redirect()->back()->with('success', 'Report Category Added');
    }

    public function update_report_category(Request $request){
        ListingReportCategories::where('id', $request->input('report_id'))->update([
            'category_name' => $request->input('category_name')
        ]);
        return redirect()->back()->with('success', 'Category name updated');
    }


    public function show_reports(Request $request){
        $rep = Reports::with('report_category')->with('user')->with('lister')->with('listing')->get();
        return view('admin.listingreports.listingreports')->with('reports', $rep);
    }
}