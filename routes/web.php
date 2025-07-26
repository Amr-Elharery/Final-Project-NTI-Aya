<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
})->name('login');

//Dummy route for home
Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create')->middleware('auth');
Route::post('/doctors/create', [DoctorController::class, 'store'])->name('doctors.store')->middleware('auth');
Route::get('/doctors/index', [DoctorController::class, 'index'])->name('doctors.index')->middleware('auth');
Route::get('/doctors/edit', [DoctorController::class, 'update'])->name('doctors.update')->middleware('auth');

