<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\PengembalianBukuController;
/**
 * Fungsi untuk memeriksa sesi pengguna berdasarkan peran.
 *
 * @param string $role
 * @return \Illuminate\Http\RedirectResponse|null
 */
function checkSession($role)
{
    session_start(); // Mulai sesi jika belum dimulai

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
        return redirect('/login')->with('error', 'Anda harus login sebagai ' . $role . ' untuk mengakses halaman ini.');
    }

    return null;
}

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pages.home');
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/contact', function () {
    return view('pages.contactus');
})->name('contact.form');
Route::get('/lupapassword', function () {
    return view('pages.lupapassword');
});
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/lupapassword', [AuthController::class, 'showResetPasswordForm'])->name('password.request');
Route::post('/lupapassword', [AuthController::class, 'sendResetPasswordLink']);
Route::get('/resetpassword/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/resetpassword/{token}', [AuthController::class, 'resetPassword'])->name('password.update');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        if ($redirect = checkSession('admin')) {
            return $redirect;
        }
        return view('admin.pages.home');
    })->name('admin.dashboard');

    Route::get('/home/{id}', [AdminController::class, 'home'])->name('home');
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    Route::get('/datapenerbit', [PenerbitController::class, 'index'])->name('datapenerbit.index');
    Route::get('/datapenerbit/create', [PenerbitController::class, 'create'])->name('datapenerbit.create');
    Route::post('/datapenerbit', [PenerbitController::class, 'store'])->name('datapenerbit.store');
    Route::get('/datapenerbit/{id}/edit', [PenerbitController::class, 'edit'])->name('datapenerbit.edit');
    Route::put('/datapenerbit/{id}', [PenerbitController::class, 'update'])->name('datapenerbit.update');
    Route::delete('/datapenerbit/{id}', [PenerbitController::class, 'destroy'])->name('datapenerbit.destroy');

    Route::get('/dataadmin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/dataadmin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/dataadmin', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/dataadmin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/dataadmin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/dataadmin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('/admin', [AnggotaController::class, 'home'])->name('home');

    Route::resource('/categories', CategoryController::class);

    Route::resource('/databuku', controller: BookController::class)->names([
        'index' => 'admin.pages.databuku.index',
        'create' => 'admin.pages.databuku.create',
        'store' => 'admin.pages.databuku.store',
        'edit' => 'admin.pages.databuku.edit',
        'update' => 'admin.pages.databuku.update',
        'destroy' => 'admin.pages.databuku.destroy',
    ]);

    Route::get('/datapeminjamanbuku', [DataBukuController::class, 'index'])->name('admin.data_buku.index');
});

// akhir router admin

/*
|--------------------------------------------------------------------------
| Anggota Routes
|--------------------------------------------------------------------------
*/
Route::prefix('anggota')->group(function () {
    // Dashboard anggota
    Route::get('/', function () {
        // Periksa sesi role anggota
        if ($redirect = checkSession('anggota')) {
            return $redirect;
        }
        return view('anggota.pages.home');
    })->name('anggota.dashboard');
    Route::get('/anggota/datapeminjaman', [PeminjamanBukuController::class, 'index'])->name('anggota.pages.peminjaman.index');
    Route::post('/anggota/datapeminjaman/store', [PeminjamanBukuController::class, 'store'])->name('anggota.pages.peminjaman.store');

    Route::get('/anggota/datapengembalian', [PengembalianBukuController::class, 'index'])->name('anggota.pages.pengembalian.index');
    Route::post('/anggota/datapengembalian/store', [PengembalianBukuController::class, 'store'])->name('anggota.pages.pengembalian.store');
});
