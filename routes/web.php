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

    Route::group(['prefix' => 'news'],function (){

        Route::get('', "IndexController@news")->name("news");

        Route::get('/{rub}', "IndexController@rubrics");

    });

    Route::group(['prefix' => 'profile',"middleware" => ["auth"]],function (){

        Route::get('', "ProfileController@index")->name("profile");

        Route::match(["get",'post'],'edit', "ProfileController@edit")->name("editprofile");

        Route::get('invite/{resp}',"ProfileController@invite");

    });

    Route::group(['prefix' => 'admin','middleware' => ['web',"auth","admin"]],function (){

        Route::get('', "AdminController@index")->name('adminIndex');

        Route::get('/users', "AdminController@users")->name('users');

        Route::get('/user/{id}', "AdminController@userEdit");
        Route::post('/user/{id}', "AdminController@userEdit");

    });

    Route::resource('post', 'PostController');

});

Route::group(['prefix' => 'ajax'],function (){

        Route::post('sendinvite',function (\Illuminate\Http\Request $request){

            $user = \App\User::find($request->id);
            $user->invite = "Хочешь в редакторы ?";
            $user->save();

            return "200";

        });

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
