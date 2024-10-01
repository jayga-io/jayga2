<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckValidRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Check if the authToken is present in the header
       if (!$request->hasHeader('authToken')) {
            return response()->json(['error' => 'User is not logged in. Please login first'], 401);
        }

        // Retrieve authToken from the header
        $authToken = $request->header('authToken');

        // Query the user table using the authToken
        $user = User::where('access_token', $authToken)->first();

        // Check if the user exists and is not suspended
        if (!$user || $user->isSuspended == true) {
            return response()->json(['error' => 'User is either invalid or suspended'], 403);
        }

        // Allow the request to continue
        return $next($request);
        
    }
}
