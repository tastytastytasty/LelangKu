<?php

use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;

Route::middleware('guest.only')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'registerMasyarakat'])->name('register');

    Route::get('/login', function () {
        return view('dashboard.login-masyarakat');
    });
    Route::post('/login', [AuthController::class, 'loginMasyarakat'])->name('login.masyarakat');

    Route::get('/', function () {
        return view('dashboard.login-petugas');
    });
    Route::post('/', [AuthController::class, 'loginPetugas'])->name('login.petugas');
});
Route::middleware('auth.only')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth.masyarakat')->group(function () {
        Route::get('/masyarakat/dashboard', fn() => view('masyarakat.dashboard'))
            ->name('masyarakat.dashboard');
    });

    Route::middleware('auth.petugas')->group(function () {
        Route::get('/petugas/dashboard', fn() => view('petugas.dashboard'));
    });

    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('/barang/form', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/form', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/form/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::patch('/barang/form/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/form/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/barang/cari', [BarangController::class, 'cari'])->name('barang.cari');

    Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat');
    Route::get('/masyarakat/form', [MasyarakatController::class, 'create'])->name('masyarakat.create');
    Route::post('/masyarakat/form', [MasyarakatController::class, 'store'])->name('masyarakat.store');
    Route::get('/masyarakat/form/{id}', [MasyarakatController::class, 'edit'])->name('masyarakat.edit');
    Route::patch('/masyarakat/form/{id}', [MasyarakatController::class, 'update'])->name('masyarakat.update');
    Route::delete('/masyarakat/form/{id}', [MasyarakatController::class, 'destroy'])->name('masyarakat.destroy');
    Route::get('/masyarakat/cari', [MasyarakatController::class, 'cari'])->name('masyarakat.cari');

    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas');
    Route::get('/petugas/form', [PetugasController::class, 'create'])->name('petugas.create');
    Route::post('/petugas/form', [PetugasController::class, 'store'])->name('petugas.store');
    Route::get('/petugas/form/{id}', [PetugasController::class, 'edit'])->name('petugas.edit');
    Route::patch('/petugas/form/{id}', [PetugasController::class, 'update'])->name('petugas.update');
    Route::delete('/petugas/form/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
    Route::get('/petugas/cari', [PetugasController::class, 'cari'])->name('petugas.cari');

    Route::get('/lelang', [LelangController::class, 'index'])->name('lelang');
    Route::get('/lelang/form', [LelangController::class, 'create'])->name('lelang.create');
    Route::post('/lelang/form', [LelangController::class, 'store'])->name('lelang.store');
    Route::get('/masyarakat/dashboard', [LelangController::class, 'dash'])->name('dash');
    Route::get('/petugas/dashboard', [LelangController::class, 'board'])->name('board');
    Route::get('/lelang/form/{id}', [LelangController::class, 'edit'])->name('lelang.edit');
    Route::patch('/lelang/form/{id}', [LelangController::class, 'update'])->name('lelang.update');
    Route::delete('/lelang/form/{id}', [LelangController::class, 'destroy'])->name('lelang.destroy');
    Route::get('/lelang/cari', [LelangController::class, 'cari'])->name('lelang.cari');

    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/history/tanggal', [HistoryController::class, 'tanggal'])->name('history.tanggal');
    Route::get('/history/cari', [HistoryController::class, 'cari'])->name('history.cari');
    Route::get('/history/status', [HistoryController::class, 'status'])->name('history.status');
    Route::get('/history/{id}', [HistoryController::class, 'detail'])->name('history.detail');

    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/masyarakat', [UserController::class, 'updateMas'])->name('profile.updmas');
    Route::post('/profile/petugas', [UserController::class, 'updatePet'])->name('profile.updpet');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/cari', [LaporanController::class, 'cari'])->name('laporan.cari');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});