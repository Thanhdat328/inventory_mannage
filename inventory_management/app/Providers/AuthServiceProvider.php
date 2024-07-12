<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Gate::define('isAdmin', function ($user) {
        //     return $user->role == 'admin';
        // });
        
        // Gate::define('isStaff', function ($user) {
        //     return $user->role == 'staff';
        // });

        // Gate::before(function ($user, $ability) {
        //     return $user->hasRole('super admin') ? true : null;
        // });

        // Gate::after(function ($user, $ability) {
        //     return $user->hasRole('super staff') ? false : null;
        // });
        //
    }
    
}
