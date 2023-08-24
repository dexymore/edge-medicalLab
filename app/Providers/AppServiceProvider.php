<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use DateTime;
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
        Validator::extend('age_above', function ($attribute, $value, $parameters, $validator) {
            $birthdate = new DateTime($value);
            $today = new DateTime();
            $age = $birthdate->diff($today)->y;
        
            // Compare the age to the threshold (16)
            return $age > 16;
        
        });
    }
}