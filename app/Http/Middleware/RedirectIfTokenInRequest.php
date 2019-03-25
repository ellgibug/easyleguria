<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfTokenInRequest
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
        if ($request->_token) {
            return redirect()->to(url()->current().'?'.http_build_query($request->except("_token")));
        }
        return $next($request);
    }
}
