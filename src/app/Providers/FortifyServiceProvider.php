<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;  
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
    }

    /**
     * Bootstrap services.
     *a
     * @return void
     */
    public function boot()
    {
        \Laravel\Fortify\Fortify::loginView(function () {
            return view('login');
        });

        \Laravel\Fortify\Fortify::registerView(function () {
            return view('register'); 
        });

    }
}
