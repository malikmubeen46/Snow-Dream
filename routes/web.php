<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('login');
});
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('admin/home', function () {
    return view('admin/home');
});

Route::match(['get', 'post'],'admin',[AuthController::class,'admin_login']);
Route::get('admin/logout',[AuthController::class,'admin_logout']);
Route::get('admin/home',[AuthController::class,'admin_home']);
Route::match(['get', 'post'],'user/{id}',[AuthController::class,'edit_user']);
Route::get('delete-user/{id}',[AuthController::class,'delete_user']);

Route::post('signup',[AuthController::class,'signup']);
Route::post('/',[AuthController::class,'login']);
Route::get('logout',[AuthController::class,'logout']);
Route::get('profile',[AuthController::class,'profile']);
Route::post('profile',[AuthController::class,'updateProfile']);