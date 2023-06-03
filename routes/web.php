<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', function () {
    return view('home');
});

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);


Route::resource('books', BookController::class)->middleware(['isAdmin', 'auth']);
Route::resource('user', UserController::class)->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('user.borrow');