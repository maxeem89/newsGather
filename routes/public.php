<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'out', 'middleware' => 'PublicMiddleware'], function (){
    Route::get("news", "NewsController@showNewsList");
    Route::get("news/{news}", "NewsController@showPublicNews")->name('news.show.out');
    Route::get("resources/{resource}", "NewsController@showResourcesList")->name('resources.show.out');
    Route::get("categories/{category}", "NewsController@showCategoryList")->name('categories.show.out');
    Route::get("login", "NewsController@login")->name('login.out');;
});

