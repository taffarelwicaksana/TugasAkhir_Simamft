<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;


class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-admin', function ($user) {
            Log::info('Checking access-admin gate for user: ', ['user' => $user->id, 'role' => $user->role->nama_role]);
            return $user->role->nama_role === 'admin';
        });

        Gate::define('access-user', function ($user) {
            Log::info('Checking access-user gate for user: ', ['user' => $user->id, 'role' => $user->role->nama_role]);
            return $user->role->nama_role === 'orangtua';
        });
    }
}