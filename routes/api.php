<?php

use Illuminate\Support\Facades\Route;


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

Route::post('/register', 'RegisterController@register');
Route::post('/checkPhoneNumber', 'RegisterController@checkPhoneNumber')->middleware('auth:sanctum');
// Route::post('/checkPhoneNumber',[])
Route::post('/inputCheck', 'RegisterController@inputCheck');

Route::get('/users', 'RegisterController@users');

Route::post('/listMemberTable', 'MemberController@listMemberTable');

Route::post('/login', 'LoginController@login');
Route::delete('/logout', 'LoginController@logout');
