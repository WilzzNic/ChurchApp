<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('guest', function ($user) {
            return $user->role == 'guest';
        });

        Gate::define('basic_congregation', function ($user) {
            return $user->role == 'basic_congregation';
        });

        Gate::define('expert_congregation', function($user) {
            return $user->role == 'expert_congregation';
        });

        Gate::define('admin', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('KAJ_leader', function($user) {
            return $user->role == 'KAJ_leader';
        });

        Gate::define('KOM_leader', function($user) {
            return $user->role == 'KOM_leader';
        });

        Gate::define('FA_leader', function($user) {
            return $user->role == 'FA_leader';
        });

        Gate::define('PA_leader', function($user) {
            return $user->role == 'PA_leader';
        });
    }
}
