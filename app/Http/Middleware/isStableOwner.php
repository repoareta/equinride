<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
class isStableOwner
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
        // cek jika user mempuntai stable
        $stable = Auth::user()->stables->first();

        // cek role stable owner
        $user = User::where('id', Auth::user()->id)->whereHas("roles", function ($q) {
            $q->where("name", "stable-owner");
        })->first();
        
        
        if ($stable and
            $user != null) {
            // Lolos ke next route
            return $next($request);
        }
        
        // JIKA BUKAN APP OWNER MAKA TIDAK BISA
        Alert::error('Alert', 'You are not a Stable Owner')->persistent(true)->autoClose(3600);
        return redirect()->back();
    }
}
