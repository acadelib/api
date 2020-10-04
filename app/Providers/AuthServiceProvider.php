<?php

namespace App\Providers;

use App\Models\Classroom;
use App\Models\SchoolYear;
use App\Policies\ClassroomPolicy;
use App\Policies\SchoolYearPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        SchoolYear::class => SchoolYearPolicy::class,
        Classroom::class => ClassroomPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
