<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidUserException;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserProtectedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$request->validate([
    		'user_id' => 'required',
	    ]);

    	if(Auth::id() !== $request->get('user_id')) {
    		throw new InvalidUserException();
	    }

        return $next($request);
    }
}
