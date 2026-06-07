<?php

namespace App\Providers;

use App\Models\TaskKAL;
use App\Observers\TaskObserverKAL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TaskKAL::observe(TaskObserverKAL::class);
    }
}

