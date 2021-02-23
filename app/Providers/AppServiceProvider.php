<?php

namespace App\Providers;

use App\Models\Stable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // SHARE STABLE PAGES
        View::composer(['stable.*'], function ($view) {
            //
            $stable = Stable::where('id', Auth::user()->stables->first()->id)
            ->withCount([
                'horses',
                'coaches',
                'packages',
            ])
            ->first();
            $view->with('stable', $stable);
        });
    }
}
