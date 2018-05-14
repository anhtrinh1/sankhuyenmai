<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Traits\HasRoles;

class CheckRole
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
        if ($request->user()->role > 1) {
             return redirect('/');
        }
        return $next($request);
    }
}
