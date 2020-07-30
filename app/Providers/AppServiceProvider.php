<?php

namespace App\Providers;

use ACL\ACLServiceProvider;
use Cuongpm\Modularization\ModularizationServiceProvider;
use English\EnglishServiceProvider;
use GoTest\GoTestServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use IO\IOServiceProvider;
use Laravel\Passport\Passport;
use Tutorial\TutorialServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::pruneRevokedTokens();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(ACLServiceProvider::class);
        $this->app->register(EnglishServiceProvider::class);
        $this->app->register(IOServiceProvider::class);
        $this->app->register(ModularizationServiceProvider::class);
        $this->app->register(TutorialServiceProvider::class);
        $this->app->register(GoTestServiceProvider::class);
    }
}
