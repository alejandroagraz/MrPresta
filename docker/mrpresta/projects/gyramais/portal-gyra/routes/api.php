<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



##PDF
Route::post('/generate/detail/contract/pdf', 'PdfController@generateDetailContractPDF')->name('generate.pdf');
Route::get('/integrateAccounts/{email}', 'Auth\LoginController@integrateAccounts');
##END PDF

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
