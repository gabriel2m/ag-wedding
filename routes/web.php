<?php

use App\Http\Controllers\Admin\GiftController as AdminGiftController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WeddingGuestController;
use App\Http\Controllers\GiftController;
use App\Http\Middleware\IsHtmx;
use App\Http\Middleware\RoutePermission;
use Illuminate\Support\Carbon;
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

Route::view('/', 'home', [
    'diff' => Carbon::createFromDate(2024, 6, 8)->startOfDay()->diffInMilliseconds(now()),
])->name('home');

Route::get('gifts', [GiftController::class, 'index'])->name('gifts.index');

Route::prefix('admin')->name('admin.')->middleware([
    'auth',
    RoutePermission::class,
    IsHtmx::layout('layouts.admin'),
])->group(function () {
    Route::name('home')->get('/', function () {
        return view('admin.home');
    });

    Route::resource('users', UserController::class)->except('show');
    Route::post('guests/{guest}/answer', [WeddingGuestController::class, 'answer'])->name('guests.answer');
    Route::resource('guests', WeddingGuestController::class)->except('show');
    Route::resource('gifts', AdminGiftController::class)->except('show');
});
