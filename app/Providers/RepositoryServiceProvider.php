<?php

namespace App\Providers;

use App\Repositories\Read\TaskReadRepository;
use App\Repositories\Read\TaskReadRepositoryInterface;
use App\Repositories\Write\TaskWriteRepository;
use App\Repositories\Write\TaskWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            TaskReadRepositoryInterface::class,
            TaskReadRepository::class
        );

        $this->app->bind(
            TaskWriteRepositoryInterface::class,
            TaskWriteRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
