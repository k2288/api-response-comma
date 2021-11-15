<?php

namespace Raahin\ApiResponse\Provider;

use Raahin\ApiResponse\ApiResponse;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('api-response', function(){
            return new ApiResponse;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'\..\resources\lang\fa' => base_path('resources/lang/fa'),
        ], 'ApiResource-lang');
    }
}
