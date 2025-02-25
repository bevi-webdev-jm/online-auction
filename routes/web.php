<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\RoleController;

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

Auth::routes();

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::group(['middleware' => 'auth'], function() {

    // ROLES ROUTES
    Route::group(['middleware' => 'permission:role access'], function() {
        Route::get('roles', [RoleController::class, 'index'])->name('role.index');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:role create');
        Route::post('role', [RoleController::class, 'store'])->name('role.store')->middleware('permission:role create');

        Route::get('role/{id}', [RoleController::class, 'show'])->name('role.show');

        Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:role edit');
        Route::post('role/{id}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:role edit');
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
