<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerPolicies();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //only admin can create travels
        Gate::define('create-travel', function ($user) {
            return $user->roles->contains('name', 'admin');
        });
        //only admin can create tours
        Gate::define('create-tour', function ($user) {
            return $user->roles->contains('name', 'admin');
        });
        //editor can only update travels
        Gate::define('update-travel', function ($user) {
            return $user->roles->contains('name', 'editor');
        });
    }
}
