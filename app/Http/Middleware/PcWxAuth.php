<?php

namespace App\Http\Middleware;

use Closure;
use Session;

/**
 * This middleware is used for wx user's automatic login.
 */
class PcWxAuth
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('user_id')) {
            return $next($request);
        } else {
            return redirect('/pc-wx-login?redirect_url=' . urlencode($request->path()));
        }
    }

}
