<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;




class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

   /**
 * Register any authentication / authorization services.
 *
 * @return void
 */
public function boot()
{
    $this->registerPolicies();
    Passport::routes(function ($router){
        $router->forAccessTokens();
    });

    // Passport::useTokenModel(Token::class);


    // Passport::routes();

    // Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
    // Passport::loadKeysFrom('C:/laragon/www/todo-laravel/storage/secrets/oauth');
}
}
