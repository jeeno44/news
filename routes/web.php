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

    // Главная страница
    Route::get('', "IndexController@index")->name("index");

    Route::group(['prefix' => 'news'],function (){

        Route::get('', "IndexController@news")->name("news");

        Route::get('rubrics/{rub}', "IndexController@rubrics");

        Route::get('/show/{id}', "IndexController@show");

    });

    // Группа маршрутов для профиля
    Route::group(['prefix' => 'profile',"middleware" => ["auth"]],function (){

        Route::get('', "ProfileController@index")->name("profile");             // Просмотр профиля пользователя

        Route::match(["get",'post'],'edit', "ProfileController@edit")->name("editprofile"); // Редактирование пользователя

        Route::get('inviteconfirm/{resp}',"ProfileController@inviteConfirm");   // Подтверждение приглашения в редакторы

        Route::post('sendinvite', "ProfileController@sendinvite");              // Приглашение в редакторы

    });

    // Группа маршрутов для администратора
    Route::group(['prefix' => 'admin','middleware' => ['web',"auth","admin"]],function (){

        Route::get('', "AdminController@index")->name('adminIndex');        // Главная страница (пустышка)

        Route::get('/users', "AdminController@users")->name('users');       // Просмотр всех пользователей с сортировкой и пагинацией по 10 шт

        Route::get('/user/{id}', "AdminController@userEdit");               // Редактирование пользователя
        Route::post('/user/{id}', "AdminController@userEdit");              // Редактирование пользователя

        Route::match(['get','post'],'rubrics',"AdminController@rubrics");   // Добавление рубрик

        Route::match(['get','post'],'tags',"AdminController@tags");         // Добавление тегов

        Route::get('logs', "AdminController@logs");                         // Просмотр логов


    });

    Route::resource('post', 'PostController');          // Контроллер для добавления, редактирования, вывода и удаления новостей

    Route::get('post/{id}/psevdoremove', 'PostController@psevdoremove');        // Удаление пользователя админом

    Route::post('post/updateApproved/{id}', 'PostController@updateApproved');   // Модерация статьи

});

Auth::routes(); // Маршруты авторизации и регистрации

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', "ProfileController@logout"); // Выход из профиля

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
