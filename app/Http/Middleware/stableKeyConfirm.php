<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class stableKeyConfirm
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
        $stable_key_login_expired_at = session('stable_key_expired_at'); // Y-m-d H:i:s
        $time_now = Carbon::now();

        // JIKA TIDAK ADA stable_key_login_expired_at MEANING IS NULL
        // ATAU JIKA SUDAH EXPIRED
        if (!$stable_key_login_expired_at || $stable_key_login_expired_at < $time_now) {
            // REDIRECT KE STABLE KEY CONFIRM
            return redirect()->route('stable.stable_key.confirm')->with(['warning' => 'Please enter your stable key']);
        }

        // JIKA stable_key_confirm_expired_at ADA DAN MASIH BELUM EXPIRED, MAKA LANJUT
        return $next($request);
    }
}
