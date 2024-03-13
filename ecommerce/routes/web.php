<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\HomepageController;
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

Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/admin/category', [CategoryController::class, 'category'])->name('category')->middleware('auth');

Route::post('/admin/category', [CategoryController::class, 'categoryInsert'])->name('categoryInsert')->middleware('auth');
Route::get('/admin/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('categoryDelete')->middleware('auth');
Route::get('/admin/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('categoryEdit')->middleware('auth');
Route::put('/admin/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate')->middleware('auth');
