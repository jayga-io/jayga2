<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;
use App\Http\Requests\StoreBankDetailsRequest;
use App\Http\Requests\UpdateBankDetailsRequest;


class BankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankDetailsRequest $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required',
            'acc_name' => 'required',
            'acc_number' => 'required',
            'branch_name' => 'required'
        ]);

        if($validated){
           
            BankDetails::create([
                'user_id' => $request->session()->get('user'),
                'acc_name' => $request->input('acc_name'),
                'acc_number' => $request->input('acc_number'),
                'bank_name' => $request->input('bank_name'),
                'routing_number' => $request->input('routing_number'),
                'branch_name' => $request->input('branch_name')
            ]);
            toastr()->addSuccess('Bank Details Saved');
            return redirect(route('acccenter'));
        }else{
            return response()->json(['errors' => $validated->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BankDetails $bankDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BankDetails $bankDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBankDetailsRequest $request, BankDetails $bankDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BankDetails $bankDetails)
    {
        //
    }
}
