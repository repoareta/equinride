<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isStableProfileComplete
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
        // cek jika profile stable sudah lengkap atau belum
        $stable = Auth::user()->stables->first();

        $stable_owner = $stable->owner;
        $stable_manager = $stable->manager;
        $stable_capacity_of_stable = $stable->capacity_of_stable;
        $stable_capacity_of_arena = $stable->capacity_of_arena;
        $stable_number_of_coach = $stable->number_of_coach;
        $stable_facilities = $stable->facilities;
        $stable_logo = $stable->logo;

        if ($stable_owner and
            $stable_manager and
            $stable_capacity_of_stable and
            $stable_capacity_of_arena and
            $stable_number_of_coach and
            $stable_facilities and
            $stable_logo) {
            // Lolos ke next route
            return $next($request);
        }
        
        // JIKA BELUM MAKA LENGKAPI PROFILE DULU
        return redirect()->route('stable.edit')->with(['warning' => 'Please Complete Your Stable Profile']);
    }
}
