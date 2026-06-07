<?php

namespace App\Providers;

use App\Models\TaskKAL;
use App\Models\CategoryKAL;
use App\Models\User;
use App\Policies\TaskPolicyKAL;
use App\Policies\CategoryPolicyKAL;
use App\Policies\UserPolicyKAL;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        TaskKAL::class => TaskPolicyKAL::class,
        CategoryKAL::class => CategoryPolicyKAL::class,
        User::class => UserPolicyKAL::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users-kal', fn ($user) => $user->role === 'admin');
    }
}

