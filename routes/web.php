<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require('web_articles.php');


Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();


Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('checkaccess:Role');
Route::post("roles/modify/{roleId}", [App\Http\Controllers\RoleController::class,'modify'])->name('roles.modify');

Route::delete("roles/alter/{roleId}", [App\Http\Controllers\RoleController::class,'alter'])->name('roles.alter');


Route::resource('users', App\Http\Controllers\UserController::class)->middleware('checkaccess:User');

Auth::routes();



