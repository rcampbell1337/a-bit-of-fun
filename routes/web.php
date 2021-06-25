<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\NavigationController::class, 'index'])->name('home');
Route::get('dashboard/', [App\Http\Controllers\QuoteController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('quote/{id}/', [App\Http\Controllers\QuoteController::class, 'show'])->name('single');
Route::get('create/', [App\Http\Controllers\QuoteController::class, 'create'])->name('create')->middleware('auth');
Route::get('edit/{id}/', [App\Http\Controllers\QuoteController::class, 'edit'])->name('edit')->middleware('auth');
Route::post('store/', [App\Http\Controllers\QuoteController::class, 'store'])->name('store');
Route::post('update/{id}/', [App\Http\Controllers\QuoteController::class, 'update'])->name('update');
Route::delete('delete/{id}/', [App\Http\Controllers\QuoteController::class, 'delete'])->name('delete');

Route::get('quote/like/{id}/', [App\Http\Controllers\LikeController::class, 'like'])->name('reply.like');
Route::get('quote/unlike/{id}/', [App\Http\Controllers\LikeController::class, 'unlike'])->name('reply.unlike');
Auth::routes();
