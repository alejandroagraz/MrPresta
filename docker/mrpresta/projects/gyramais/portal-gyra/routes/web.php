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

Route::get('/', function () {
    return redirect('login');
})->name('home');
Route::get('/login', function () {
    return view('users.login');
})->name('login');
Route::get('/home', function () {
    return view('home.index');
})->name('home');
Route::get('/applications', function () {
    return view('applications.index');
})->name('applications');
Route::get('/loans', function () {
    return view('loans.index');
})->name('loans');
Route::get('/integrations', function () {
    return view('integrations.index');
})->name('integrations');
Route::get('/usuarios', function () {
    return view('users.index');
})->name('usuarios');
Route::get('/profile', function () {
    return view('profile.index');
})->name('profile');

Route::get('/owners', 'OwnerController@getOwners')->name('owners');
Route::delete('/status/owner/{id}', 'OwnerController@statusOwner')->name('status.owner');
Route::get('/social/accounts/registered', 'OwnerController@getSocialAccountsRegistered')->name('social.accounts.registered');
Route::get('/ml/accounts/registered', 'OwnerController@getMLAccountsRegistered')->name('ml.accounts.registered');
Route::get('/set/ml/{idML}', 'OwnerController@setML')->name('set.ml');
Route::get('/get/global/data', 'OwnerController@getGlobalData')->name('get.global.data');


Route::post('/post-login', 'Auth\LoginController@login')->name('post-login');

Route::get('/auth/mercadolibre/{flag}', 'Auth\LoginController@redirectToProviderMercadoLibre');
Route::get('/auth/mercadolibre', 'Auth\LoginController@redirectToProviderMercadoLibre');
Route::get('/auth/facebook', 'Auth\LoginController@redirectToProviderFacebook')->name('login-facebook');
Route::get('auth/facebook/callback', 'Auth\LoginController@handleProviderCallbackFacebook');
Route::get('/auth/google', 'Auth\LoginController@redirectToProviderGoogle')->name('login-google');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallbackGoogle');

##AUTH
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::post('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

##END AUTH

##PDF
//Route::post('/test/html', 'PdfController@testHTML')->name('test.html');
##END PDF

Route::group(['prefix' => 'admin'], function () {
//    Auth::routes();
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/register-owner', 'Auth\RegisterController@register')->name('register-owner');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

});
Route::get('/getOpportunities/{clienteId?}', 'Application\SearchDataController@getOpportunities')
    ->name('getOpportunities');
Route::get('/getAppParams', 'Application\SearchDataController@getAppParams')->name('getAppParams');
Route::post('/registerApp', 'Application\RegisterController@store')->name('registerApp');

Route::get('/get-profile', 'Profile\SearchDataController@getProfile')->name('get-profile');
Route::post('/update-profile', 'Profile\UpdateController@updateProfile')->name('update-profile');
Route::post('/update-picture', 'Profile\UpdateController@updatePicture')->name('update-picture');
