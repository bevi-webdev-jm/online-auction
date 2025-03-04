<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\{
    RoleController, UserController, CompanyController, 
    SystemLogController, ItemController, AuctionController,
    BiddingController
};

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

    // BIDDINGS ROUTE
    Route::group(['middleware' => 'permission:bidding access'], function() {
        Route::get('bidding/{id}', [BiddingController::class, 'index'])->name('bidding.index');
        Route::get('bidding/{id}/list', [BiddingController::class, 'list'])->name('bidding.list')->middleware('permission:bidding list');
    });

    // AUCTIONS ROUTES
    Route::group(['middleware' => 'permission:auction access'], function() {
        Route::get('auctions', [AuctionController::class, 'index'])->name('auction.index');
        Route::get('auction/create', [AuctionController::class, 'create'])->name('auction.create')->middleware('permission:auction access');
        Route::post('auction', [AuctionController::class, 'store'])->name('auction.store')->middleware('permission:auction create');

        Route::get('auction/{id}', [AuctionController::class, 'show'])->name('auction.show');

        Route::get('auction/{id}/edit', [AuctionController::class, 'edit'])->name('auction.edit')->middleware('permission:auction edit');
        Route::post('auction/{id}', [AuctionController::class, 'update'])->name('auction.update')->middleware('permission:auction edit');
    });

    // ITEMS ROUTES
    Route::group(['middleware' => 'permission:item access'], function() {
        Route::get('items', [ItemController::class, 'index'])->name('item.index');
        Route::get('item/create', [ItemController::class, 'create'])->name('item.create')->middleware('permission:item create');
        Route::post('item', [ItemController::class, 'store'])->name('item.store')->middleware('permission:item create');

        Route::get('item/{id}', [ItemController::class, 'show'])->name('item.show');

        Route::get('item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit')->middleware('permission:item edit');
        Route::post('item/{id}', [ItemController::class, 'update'])->name('item.update')->middleware('permission:item edit');
    });

    // COMPANIES ROUTES
    Route::group(['middleware' => 'permission:company access'], function() {
        Route::get('companies', [CompanyController::class, 'index'])->name('company.index');
        Route::get('company/create', [CompanyController::class, 'create'])->name('company.create')->middleware('permission:company create');
        Route::post('company', [CompanyController::class, 'store'])->name('company.store')->middleware('permission:company create');

        Route::get('company/{id}', [CompanyController::class, 'show'])->name('company.show');

        Route::get('company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit')->middleware('permission:company edit');
        Route::post('company/{id}', [CompanyController::class, 'update'])->name('conpany.update')->middleware('permission:company edit');
    });

    // ROLES ROUTES
    Route::group(['middleware' => 'permission:role access'], function() {
        Route::get('roles', [RoleController::class, 'index'])->name('role.index');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:role create');
        Route::post('role', [RoleController::class, 'store'])->name('role.store')->middleware('permission:role create');

        Route::get('role/{id}', [RoleController::class, 'show'])->name('role.show');

        Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:role edit');
        Route::post('role/{id}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:role edit');
    });

    // USERS ROUTES
    Route::group(['middleware' => 'permission:user access'], function() {
        Route::get('users', [UserController::class, 'index'])->name('user.index');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:user create');
        Route::post('user', [UserController::class, 'store'])->name('user.store')->middleware('permission:user create');

        Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');

        Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:user edit');
        Route::post('user/{id}', [UserController::class, 'update'])->name('user.update')->middleware('permission:user edit');
    });

    // SYSTEM LOG ROUTES
    Route::group(['middleware' => 'permission:system logs'], function() {
        Route::get('system-logs', [SystemLogController::class, 'index'])->name('system-logs');
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
