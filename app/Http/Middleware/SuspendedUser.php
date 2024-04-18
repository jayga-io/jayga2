<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class SuspendedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->session()->get('user');
        $user = User::where('id', $id)->get();

        if($user[0]->isSuspended == true){
           
            return redirect(route('home'))->with('error', 'User account suspended');
        }else{
            return $next($request);
        }
       
    }
}
