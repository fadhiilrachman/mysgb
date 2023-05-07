<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MembershipController;
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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/membership/status', [MembershipController::class, 'status'])->name('membership.status');

    // Sharing
    Route::get('/sharing', [SharingController::class, 'list'])->name('sharing.list');
    Route::get('/sharing/list.json', [SharingController::class, 'listAjax'])->name('sharing.list-ajax');

    Route::get('/sharing/my-list', [SharingController::class, 'myList'])->name('sharing.my-list');
    Route::get('/sharing/my-list.json', [SharingController::class, 'myListAjax'])->name('sharing.my-list-ajax');

    Route::get('/sharing/create-new', [SharingController::class, 'create'])->name('sharing.create-new');
    Route::post('/sharing/create-new', [SharingController::class, 'store'])->name('sharing.store');

    Route::get('/sharing/{id}', [SharingController::class, 'detail'])->name('sharing.detail');
    Route::post('/sharing/{id}', [SharingController::class, 'detail'])->name('sharing.detail');

    Route::get('/history', [HistoryController::class, 'view'])->name('history.view');
    Route::get('/history/list.json', [HistoryController::class, 'listAjax'])->name('history.list-ajax');
});