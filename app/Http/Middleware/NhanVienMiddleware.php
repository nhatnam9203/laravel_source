<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NhanVienMiddleware
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
        if(Auth::guard('admin')->check()){
            $admin = Auth::guard('admin')->user();
            if($admin->level == 0 || $admin->level == 1){
                // View::share('admin',$admin);
                return $next($request);
                
            }
        }
        return redirect('/noright');
    }
}
