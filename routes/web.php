<?php

use App\Entity\User\Permission;
use App\Entity\User\User;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Entity\User\Role;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/login/phone', 'Auth\LoginController@phone')->name('login.phone');
Route::post('/login/phone', 'Auth\LoginController@verify');
Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group(
    [
        'prefix' => 'cabinet',
        'as' => 'cabinet.',
        'namespace' => 'Cabinet',
        'middleware' => ['auth'],
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', 'ProfileController@index')->name('home');
            Route::get('/edit', 'ProfileController@edit')->name('edit');
            Route::put('/update', 'ProfileController@update')->name('update');
            Route::post('/phone', 'PhoneController@request');
            Route::get('/phone', 'PhoneController@form')->name('phone');
            Route::put('/phone', 'PhoneController@verify')->name('phone.verify');
            Route::post('/phone/auth', 'PhoneController@auth')->name('phone.auth');
        });
    }
);


//Route::get('test/{id}', function () {
//    dd("123");
//})->where('id', '[0-9]+');

Route::apiResource('tasks', 'TestController');


Route::get('test2/{user}/update', 'Test2Controller');

Route::get('users/{user}', function (User $user) {
    //$user = User::findOrFail($id);
    dd($user);
});

Route::get('test3', function (Illuminate\Foundation\Application $app) {
    dd($app);
});

Route::get('test4', function() {
    Role::find(1)->rPermissions->each(function ($test) {
        dump($test);
    });
});
//
//Route::view('test5', 'layouts.dashboard', [
//    'users' => User::all()
//]);
//
//Route::view('test6', 'layouts.include', [
//    'pageName' => 'Page Name',
//    'text' => 'text бла бла бла',
//    'users' => User::all()
//]);
//
//Route::view('test7', 'layouts.components');
