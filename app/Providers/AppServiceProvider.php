<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Contracts\AuthorizationViewResponse;
//use Laravel\Passport\Http\Responses\DefaultAuthorizationViewResponse;
use Laravel\Passport\Passport;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(
//            AuthorizationViewResponse::class,
//            DefaultAuthorizationViewResponse::class
//        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // By providing a view name...
        Passport::authorizationView(function ($parameters) {
            return view('auth.oauth.authorize', [
                'client' => $parameters['client'],
                'user' => $parameters['user'],
                'scopes' => $parameters['scopes'],
                'request' => $parameters['request'],
                'authToken' => $parameters['authToken'], // Ensure this is passed
            ]);
        });
        Passport::tokensExpireIn(now()->addDays(1));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

    }
}
