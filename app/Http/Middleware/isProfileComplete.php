<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isProfileComplete
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
        // cek jika profile user sudah lengkap atau belum
        $user_sex = Auth::user()->sex;
        $user_birthdate = Auth::user()->birth_date;
        $user_phone = Auth::user()->phone;
        $user_address = Auth::user()->address;

        if ($user_sex and
        $user_birthdate and
        $user_phone and
        $user_address) {
            // Lolos ke next route
            return $next($request);
        }
        
        // JIKA BELUM MAKA LENGKAPI PROFILE DULU
        return redirect()->route('user.personal_information')->with(['warning' => 'Please Complete Your Profile']);
    }
}
