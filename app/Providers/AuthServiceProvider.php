<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\ProfilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'A pp\Policies\ModelPolicy',
        //'App\Models\User' => 'App\Policies\ProfilePolicy', //Formato antiguo
        User::class => ProfilePolicy::class, //Formato moderno
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {   
        $this->registerPolicies();

        //
    }
}
