<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class HasProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $profile = User::where('id', $request->session()->get('user'))->get();
        if($profile[0]->name == null && $profile[0]->email == null){
            return redirect(route('userprofile'))->with('messege', 'Please complete your account details before proceed');
        }else{
            return $next($request);
        }
        
    }
}
