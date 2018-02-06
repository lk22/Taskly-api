<?php

namespace Taskly\Providers;

use Laravel\Passport\Passport;

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
        'Taskly\Model' => 'Taskly\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensExpireIn(\Carbon\Carbon::now()->addDays(15));

        Passport::refreshTokensExpireIn(\Carbon\Carbon::now()->addDays(30));

        // apply token guard scopes
        Passport::tokensCan([
            'update-task' => 'update the existing task',
            'create-task' => 'creating new task ressource',
            'update-work-hours' => 'update the working hours',
            'update-deadline' => 'update the existing deadline'
        ]);
    }
}