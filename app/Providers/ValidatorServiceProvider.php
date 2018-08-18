<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('maxWord', function( $attribute, $value, $parameters, $validator) {
                    $words = explode(' ', $value);
                    $nbWords = count($words);
                    return ($nbWords >=0 && $nbWords <= 250);
                });

        Validator::replacer('maxWord', function($message, $attribute, $rule, $parameters) {
                    return str_replace(':maxWord', $parameters[0], $message);
                });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
