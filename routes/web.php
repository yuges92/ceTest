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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::group(['middleware' => ['auth']],function () {
//    Route::get('clients', 'ClientController@index');
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', 'PageController@index')->where('any', '.*');
    Route::get('/admin/{any}', 'PageController@index')->where('any', '.*');

});
