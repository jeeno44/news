<?php

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

Route::group(['prefix' => '/'],function (){

    Route::get('', "IndexController@index")->name("index");

    Route::get('news', "IndexController@news")->name("news");

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout',function (){

    if (\Illuminate\Support\Facades\Auth::check()){
        \Illuminate\Support\Facades\Auth::logout();
        return redirect()->route("index");
    }
    else{
        return redirect()->back();
    }

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
