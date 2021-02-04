<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isHasStable
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
        // cek apakah sudah punya stable atau belum
        $stable = optional(Auth::user()->stables)->first();

        // jika punya maka
        // Redirect ke stable dashboard
        if ($stable) {
            return redirect()->route('stable.index');
        }

        // jika null maka lanjut next request
        return $next($request);
    }
}
