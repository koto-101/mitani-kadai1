<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;


Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'send']);
Route::get('/admin', [ContactController::class, 'dashboard']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/export', [AdminController::class, 'export']);
Route::get('/admin/{id}', [AdminController::class, 'show']);
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

Route::get('/register', [UserController::class, 'registerForm']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/contact', function () {
    return view('contact');
});

