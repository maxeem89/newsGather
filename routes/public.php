<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'out', 'middleware' => 'PublicMiddleware'], function (){

    Route::get("news/{news}", "NewsController@showPublicNews")->name('news.show.out');

});


