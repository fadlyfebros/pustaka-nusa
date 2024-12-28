<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('pages.home', ['title' => 'Home']);
});


// Rute Auth
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', function () {
    return view('admin.pages.home'); // Create the view at resources/views/admin/dashboard.blade.php
})->name('admin.dashboard');

Route::get('/admin/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::get('/admin/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');


Route::resource('/admin/datapenerbit', PenerbitController::class);

Route::resource('/admin/dataadmin', AdminController::class);


Route::get('/admin', [AnggotaController::class, 'home'])->name('home');

Route::get('/admin/datapeminjamanbuku', function () {
    return view('admin.pages.datapeminjamanbuku');
});


// Menampilkan kategori
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.pages.categories');

// Menyimpan kategori baru
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');

// Mengupdate kategori
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

// Menghapus kategori
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::resource('/admin/books', BookController::class);


