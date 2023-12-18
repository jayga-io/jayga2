<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\BankDetails;

class HasBankAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bank = BankDetails::where('lister_id', $request->session()->get('user'))->get();
        if(count($bank)>0){
           return $next($request); 
        }else{
            return redirect()->back()->with('note', 'Please add your bank account first');
        }
        
    }
}
