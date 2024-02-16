<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\IsHtmx;
use App\Http\Middleware\RoutePermission;
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

Route::get('/', function () {
    return to_route('admin.home');
})->name('home');

Route::prefix('admin')->name('admin.')->middleware([
    'auth',
    RoutePermission::class,
    IsHtmx::layout('layouts.admin'),
])->group(function () {
    Route::name('home')->get('/', function () {
        return view('admin.home');
    });

    Route::resource('users', UserController::class)->except('show');
});
