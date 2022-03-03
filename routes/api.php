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
Route::view('/form', 'main');
Route::view('/', 'index')->name('index');
Route::post('/register', 'UserController@saveRegister')->name('register');
Route::post('/checkPhoneNumber', 'UserController@checkPhoneNumer')->name('checkPhoneNumer');

Route::middleware('auth')->group(function () {
    Route::view('/main', 'main')->name('main');
    Route::view('/reward', 'reward');
    Route::view('/topspender', 'topSpender');
    Route::view('/rule', 'rule');
    Route::view('/receipt', 'receipt');
    Route::post('/receiptCheck', 'UserController@inputCheck')->name("inputCodeForm");
    Route::post('/receiptType', 'UserController@checkType')->name("checkType");
    Route::get('/history', 'UserController@getHistory')->name("history");
});



Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
