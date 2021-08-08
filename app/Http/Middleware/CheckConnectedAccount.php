<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\EntityEnums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckConnectedAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->accounts->count() <= 0)
            return redirect()->route(EntityEnums::ACCOUNTS);

        return $next($request);
    }
}
