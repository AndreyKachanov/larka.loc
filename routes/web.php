<?php

use App\Entity\Contact;
use App\Entity\User\Permission;
use App\Entity\User\User;
use App\Http\Controllers\CourtHearingsController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\GetCourtSessions;
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

Route::get('test5', function() {
    $contact = Contact::first();
    $contact->stars()->create();
    dd($contact);
});

Route::get('test8', function() {
    //\Illuminate\Support\Facades\Redis::set('name', 'Taylor');
    dd(\Illuminate\Support\Facades\Redis::get('name'));
});

Route::get('test7', function() {
// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://hcac.court.gov.ua/new.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "q_court_id=4910");
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Cookie: PHPSESSID=qmvdf773bcv16tlqpu3p0148k7';
    $headers[] = 'Origin: https://hcac.court.gov.ua';
    $headers[] = 'Accept-Encoding: gzip, deflate, br';
    $headers[] = 'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7';
    $headers[] = 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
    $headers[] = 'Accept: application/json, text/javascript, */*; q=0.01';
    $headers[] = 'Cache-Control: max-age=0';
    $headers[] = 'X-Requested-With: XMLHttpRequest';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Referer: https://hcac.court.gov.ua/hcac/gromadyanam/hcac';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    dump(json_decode($result));
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
});

Route::get('hcac', [CourtHearingsController::class, 'hcac'])
    ->name('hcac')
    ->middleware(GetCourtSessions::class);


Route::get('apel_hcac', [CourtHearingsController::class, 'apel_hcac'])->name('apel_hcac');
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
