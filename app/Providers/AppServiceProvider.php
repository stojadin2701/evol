<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Validator::extend('checkDateOrder', function($attribute, $value, $parameters, $validator) {
        return strtotime(array_get($validator->getData(), $parameters[0])) < strtotime(array_get($validator->getData(), $parameters[1]));
      });
      Validator::replacer('checkDateOrder', function($message, $attribute, $rule, $parameters) {
        return "The event start date must be before the end date.";
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
