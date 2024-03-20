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
        //admin can only create travel
        Gate::define('create-travel', function ($user) {
            return $user->hasRole('admin');
        });
        //admin can only create tour
        Gate::define('create-tour', function ($user) {
            return $user->hasRole('admin');
        });
        //editor can only update their own travel
        Gate::define('update-travel', function ($user, $travel) {
            return $user->hasRole('editor') && $user->id === $travel->user_id;
        });
    }
}
