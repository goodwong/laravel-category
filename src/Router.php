<?php

namespace Goodwong\Category;

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
        Route::namespace('Goodwong\Category\Http\Controllers')->group(function () {
        	Route::resource('categories', 'CategoryController');
        });
    }
}
