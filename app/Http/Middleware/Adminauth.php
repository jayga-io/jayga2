<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Adminauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check = $request->session()->get('admin');
        $pip = $request->session()->get('pip');
        if(!$check == null && $check === 'J@yga2024' || $pip === 'J@yga2024'){
            return $next($request);
        }else{
            return redirect(route('adminlogin'))->with('warning', 'You are not logged in yet');
        }
        
    }
}
