<?php

namespace App\Providers;

use App\Validators\CustomValidator;
use Illuminate\Support\Facades\Validator;
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
        Validator::resolver(function ($translator, $data, $rules, $messages, $attributes) {
            return new CustomValidator($translator, $data, $rules, $messages, $attributes);
        });
        Validator::extend('katakana', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[ァ-ヾー]+$/u', $value);
        });
    }
}