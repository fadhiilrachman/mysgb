<?php

use App\Http\Controllers\DevicesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ShieldController;
use App\Http\Controllers\SharingController;
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

Route::get('/', [HomeController::class, 'home'])
    ->name('home');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Membership
    Route::prefix('membership')->name('membership.')->group(function () {
        Route::get('status', [MembershipController::class, 'status'])->name('status');
    });

    // Sharing
    Route::prefix('sharing')->name('sharing.')->group(function () {
        Route::get('/', [SharingController::class, 'list'])->name('list');
        Route::get('list.json', [SharingController::class, 'listAjax'])->name('list-ajax');

        Route::get('my-list', [SharingController::class, 'myList'])->name('my-list');
        Route::get('my-list.json', [SharingController::class, 'myListAjax'])->name('my-list-ajax');

        Route::get('create-new', [SharingController::class, 'create'])->name('create-new');
        Route::post('create-new', [SharingController::class, 'store'])->name('store');

        Route::get('{id}', [SharingController::class, 'detail'])->name('detail');
        Route::post('{id}', [SharingController::class, 'detail'])->name('detail');
    });

    // Shield
    Route::prefix('shield')->name('shield.')->group(function () {
        Route::get('/', [ShieldController::class, 'list'])->name('list');
        Route::get('list.json', [ShieldController::class, 'listAjax'])->name('list-ajax');

        Route::get('build-new', [ShieldController::class, 'build'])->name('build-new');
        Route::post('build-new', [ShieldController::class, 'store'])->name('build-new');
        
        Route::get('{id}', [ShieldController::class, 'detail'])->name('detail');
    });

    // Devices
    Route::prefix('devices')->name('devices.')->group(function () {
        Route::get('/', [DevicesController::class, 'list'])->name('list');
    });

    // History
    Route::prefix('history')->name('history.')->group(function () {
        Route::get('/', [HistoryController::class, 'view'])->name('view');
        Route::get('list.json', [HistoryController::class, 'listAjax'])->name('list-ajax');
    });
});