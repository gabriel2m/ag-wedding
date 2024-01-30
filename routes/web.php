<?php

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

Route::middleware(['auth', RoutePermission::class])->prefix('admin')->name('admin.')->group(function () {
    Route::name('home')->get('/', function () {
        return view('admin.home');
    });
});
