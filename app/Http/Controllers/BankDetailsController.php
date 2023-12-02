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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankDetailsRequest $request)
    {
        //
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
