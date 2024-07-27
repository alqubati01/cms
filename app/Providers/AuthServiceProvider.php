<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        if (! $this->app->routesAreCached()) {
            Passport::ignoreRoutes();
//            Passport::hashClientSecrets();
//            Passport::tokensExpireIn(now()->addDays(15));
//            Passport::refreshTokensExpireIn(now()->addDays(30));
//            Passport::personalAccessTokensExpireIn(now()->addMonths(6));

//            Passport::tokensCan([
//                'get-email' => 'Retrieve the email associated with your account',
//                'create-posts' => 'Create posts on behalf of your user',
//            ]);
        }
    }
}
