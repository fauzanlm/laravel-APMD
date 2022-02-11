<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PetugasController;
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
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/', function () {
        return redirect('/register');
    });
    Route::get('/password/reset', function () {
        return redirect('/register');
    });
    Route::get('/login', function () {
        return redirect('/register');
    });

    Auth::routes([
        'password.reset' => false,
        'verify' => true,
        'password.request' => false,
        'reset' => false,
    ]);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

        Route::group(['middleware' => 'masyarakat'], function () {
            Route::get('/masyarakat', [MasyarakatController::class, 'index'])->name('masyarakat.home');
            Route::get('/masyarakat/laporkan', [MasyarakatController::class, 'create'])->name('masyarakat.laporkan');
            Route::post('/masyarakat/laporkan/post', [MasyarakatController::class, 'store'])->name('masyarakat.laporkan.post');
        });

        Route::group(['middleware' => 'admin'], function () {
            Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
            Route::get('/admin/petugas', [AdminController::class, 'petugas'])->name('admin.petugas');
            Route::get('/admin/petugas/add', [AdminController::class, 'petugasAdd'])->name('admin.petugas.add');
            Route::post('/admin/petugas/add/post', [AdminController::class, 'petugasAddPost'])->name('admin.petugas.add.post');
            Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
            Route::get('/admin/laporan/belum-ditanggapi', [AdminController::class, 'laporanBelumDitanggapi'])->name('admin.laporan.belum.ditanggapi');
            Route::get('/admin/laporan/proses', [AdminController::class, 'laporanDalamProses'])->name('admin.laporan.dalam.proses');
            Route::get('/admin/laporan/selesai', [AdminController::class, 'laporanSudahSelesai'])->name('admin.laporan.sudah.selesai');
        });

        Route::group(['middleware' => 'petugas'], function () {
            Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.home');
            Route::get('/petugas/laporan', [PetugasController::class, 'laporan'])->name('petugas.laporan');
            Route::get('/petugas/laporan/add', [PetugasController::class, 'laporanAdd'])->name('petugas.laporan.add');
            Route::post('/petugas/laporan/add/post', [PetugasController::class, 'laporanAddPost'])->name('petugas.laporan.add.post');
            Route::get('/petugas/laporan/selesai', [PetugasController::class, 'laporanSelesai'])->name('petugas.laporan.selesai');
            Route::patch('/petugas/laporan/toproses/{id}', [PetugasController::class, 'toProses'])->name('petugas.laporan.toproses');
            Route::get('/petugas/laporan/toselesai/{id}', [PetugasController::class, 'toSelesai'])->name('petugas.laporan.toselesai');
        });
    });
});
