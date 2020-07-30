<?php

namespace GoTest;

use GoTest\Http\Repositories\QuestionRepository;
use GoTest\Http\Repositories\QuestionRepositoryEloquent;
use GoTest\Http\Repositories\QuestionTestRepository;
use GoTest\Http\Repositories\QuestionTestRepositoryEloquent;
use GoTest\Http\Repositories\TestRepository;
use GoTest\Http\Repositories\TestRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class GoTestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database');
        $this->loadRoutesFrom(__DIR__ . '/../routers/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../routers/api.php');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');
    }

    public function register()
    {
        $this->app->bind(QuestionRepository::class, QuestionRepositoryEloquent::class);
        $this->app->bind(QuestionTestRepository::class, QuestionTestRepositoryEloquent::class);
        $this->app->bind(TestRepository::class, TestRepositoryEloquent::class);
    }
}
