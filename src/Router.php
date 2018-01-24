<?php

namespace Goodwong\LaravelCategory;

use Illuminate\Support\Facades\Route;

class Router
{
    /**
     * product routes
     * 
     * @return void
     */
    public static function category()
    {
        Route::namespace('Goodwong\LaravelCategory\Http\Controllers')->group(function () {
        	Route::resource('categories', 'CategoryController');
        });
    }
}