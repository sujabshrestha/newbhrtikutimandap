<?php

namespace Auth\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;
use Illuminate\Support\Facades\Auth;

class VendorMiddleware
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
        
        if (Auth::check() ) {
            $user = Auth::user();
            if($user->hasRole('vendor')){
                return $next($request);
            }else{
                Auth::logout();
                Toastr::error('You do not have permission.');
                return redirect()->route('vendor.login');
            }
        }
        else{
            Toastr::error('Please Login Before Proceeding!!');
            return redirect()->route('vendor.login');
        }

    
    }
}
