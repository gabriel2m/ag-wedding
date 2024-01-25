<?php

use Illuminate\Support\Facades\DB;
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

Route::get('/info', function () {
    phpinfo();
});

Route::get('/db', function () {
    dump(
        DB::table('users')->get()
    );
});

Route::get('/', function () {
    return to_route('admin.home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.home')->get('/', function () {
            return view('admin.home');
        })->can('admin.home');
    });
});
