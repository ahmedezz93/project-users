<?php

use App\Http\Controllers\UserController;
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

Route::get('/',[UserController::class,'index'])->name('users');

Route::get('create_user/{type}',[UserController::class,'create'])->name('create_user');
Route::post('store_user',[UserController::class,'store'])->name('store_user');
Route::get('edit_user/{id}',[UserController::class,'edit'])->name('edit_user');
Route::get('destroy_user/{id}',[UserController::class,'destroy'])->name('destroy_user');
Route::post('update_user',[UserController::class,'update'])->name('update_user');
Route::post('save_image_in_folder',[UserController::class,'save_image_in_folder'])->name('save_image_in_folder'); //save images on server
Route::get('user_certification/{id}',[UserController::class,'user_certification'])->name('user_certification'); //show user certification

