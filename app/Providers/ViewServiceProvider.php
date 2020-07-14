<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Code;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Binding view composer for codes listing
        View::composer('list', function ($view) {
            $view->with(['codes'=>Code::get()]);
        });
        // Binding view composer for user profiles
        View::composer('user.profile', function ($view){
            $view->with(['user' => Auth::user()]);
        });
    }
}
