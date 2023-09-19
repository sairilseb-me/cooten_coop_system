<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoanTypeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\UserControler;
use App\Models\CootenPosition;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('/user', UserControler::class);
    Route::resource('/loan', LoanTypeController::class);
    Route::resource('/office', OfficeController::class);
});

Route::prefix('personal')->middleware('auth')->group(function() {
    Route::get('/', [PersonalController::class, 'index'])->name('personal.home');
});

Route::get('/about', function () {
    return view('about');
})->name('about');
