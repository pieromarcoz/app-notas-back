<?php

namespace App\Providers;

use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\Interfaces\AuthInterface;
use App\Http\Repositories\Interfaces\NotaInterface;
use App\Http\Repositories\Interfaces\UserInterface;
use App\Http\Repositories\NotaRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(NotaInterface::class, NotaRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
