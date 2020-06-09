<?php

namespace App\Http\Middleware;

use Closure;

class Thankyou
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
        return $next($request);
        $request->session()->flash("error", "You don't have access to these routes.");
        return redirect()->route('headoffice.index');
    }
}
