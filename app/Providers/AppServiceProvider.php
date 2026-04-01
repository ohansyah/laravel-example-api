<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \DB::listen(function ($query) {
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;

            // Log Query and Bindings with values
            $fullQuery = vsprintf(str_replace('?', "'%s'", $sql), $bindings);
            \Log::info('Time: ' . $time . 'ms; Query: ' . $fullQuery);
        });
    }
}
