<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use App\Listeners\StoreCustomSession;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            StoreCustomSession::class,
        ],
    ];
    
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
