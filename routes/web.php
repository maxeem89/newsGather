<?php
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers\Web'], function () {
    /**
     * Home Routes
     */

    Route::get('/', 'HomeController@index')->name('home.index');


    Route::group(['middleware' => ['auth', 'permission']], function () {
        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });
        Route::get('news/getCategories/{resource?}','newsController@getCategories')->name('news.getCategories');
        Route::get('resources/properties/{resource?}','ResourcesController@getProperties')->name('resources.properties');
        Route::get('news/callApi/','newsController@callApi')->name('news.callApi');
        Route::resource('news', 'NewsController');
        Route::resource('categories', 'CategoriesController');
        Route::resource('resources', 'ResourcesController');
        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController');
    });

});
