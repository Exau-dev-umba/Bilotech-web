<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
resources/views/users| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require 'web_articles.php';

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('checkaccess:Role');

Route::post('roles/modify/{roleId}', [App\Http\Controllers\RoleController::class, 'modify'])->name('roles.modify');


Route::delete('roles/alter/{roleId}', [RoleController::class, 'alter'])->name('roles.alter');

Route::resource('users', App\Http\Controllers\UserController::class)->middleware('checkaccess:User');
Route::resource('articles', ArticleController::class)->middleware('checkaccess:Article');
Route::post('articles/{id}/restore', 'App\Http\Controllers\ArticleController@restoreArticle')->name('articles.restore');
Route::get('/trashed', [ArticleController::class, 'trashed'])->name('articles.trashed');
Route::get('/sold', [ArticleController::class, 'sold'])->prefix('article/');
Route::get('/my_purchases', [ArticleController::class, 'my_purchases'])->prefix('article/');

Auth::routes();
