<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [DosenController::class, 'index'])->name('dashboard')->middleware('verified');

Auth::routes(['verify' => true]);

// prefix routes khusus admin/*
Route::prefix('admin')->namespace('admin')->name('admin.')->middleware('verified')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::post('/dosen/{dosen}', [DosenController::class, 'destroy'])->name('dosen.destroy');

});


// routes khusus admin dashboard
// Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')->middleware('EnsureUserRole:admin')->group(function () {
//     Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');

//     // admin checkout
//     Route::post('checkout/{checkout}', [AdminCheckout::class, 'update'])->name('checkout.update');
// });

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
