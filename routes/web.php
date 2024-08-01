<?php

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
    return view('welcome');
});

// API пишу в web.php из за middleware.

/*Route::get('/admin/dashboard', function () {
    return view('dashboard');
});*/

Route::get('/api/users', [\App\Http\Controllers\UserController::class, 'index']);
Route::post('/api/users', [\App\Http\Controllers\UserController::class, 'store']);

Route::get('{view}', \App\Http\Controllers\ApplicationController::class)->where('view', '(.*)');
