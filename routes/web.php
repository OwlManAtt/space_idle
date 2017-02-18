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

// Unauthenticated pages
Route::get('/', function () {
    return view('welcome');
});

// Disallow if authed
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', function () {
        return view('user.login');
    });
});

Route::get('user/login/{provider}', 'User\AuthController@redirectToProvider');
Route::get('user/login/{provider}/callback', 'User\AuthController@redirectToProvider');
Route::get('user/logoff', 'User\AuthController@logoff');

// Special pages that should not have the extra checks (ex redir to suspended page)
// because they would cause a redirect loop or other unfortunate behaviour.
Route::get('user/register', 'User\ProfileController@getRegister');
Route::post('user/register', 'User\ProfileController@postRegister');

Route::get('/user/suspended', 'User\AuthController@getSuspended');

// Normal routes.
Route::group(['middleware' => ['authed_checks']], function () {
    Route::get('/harvest', 'HarvestController@getOverview');
});
