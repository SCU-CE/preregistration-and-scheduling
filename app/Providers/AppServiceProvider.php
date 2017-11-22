<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // db configuration
        Schema::defaultStringLength(191);

        // custom validations
        Validator::extend('valid_pass', function($attribute, $value, $parameters, $validator) {
            if(password_verify($value, Auth::user()->password)){
                return true;
            }
            return false;
        });
        Validator::extend('valid_email', function($attribute, $value, $parameters, $validator) {
            if(($value == Auth::user()->email) || (($value != Auth::user()->email) && (User::where('email', $value)->count() == 0))){
                return true;
            }
            return false;
        });
        Validator::extend('valid_sid', function($attribute, $value, $parameters, $validator) {
            if(($value == Auth::user()->student->studentId) || (($value != Auth::user()->student->studentId) && (Student::where('studentId', $value)->count() == 0))){
                return true;
            }
            return false;
        });
        Validator::extend('persian', function($attribute, $value, $parameters, $validator) {
            $pattern = '/^[\s\x{0600}-\x{06FF}0-9]*$/u';
            if(preg_match($pattern,$value)){
                return true;
            }
            return false;
        });
        Validator::extend('enfa_num', function($attribute, $value, $parameters, $validator) {
            $pattern = '/^[\s\x{0600}-\x{06FF}0-9A-Za-z]*$/u';
            if(preg_match($pattern,$value)){
                return true;
            }
            return false;
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
