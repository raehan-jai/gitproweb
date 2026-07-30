<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TemplateSertifikatController;
use App\Http\Controllers\AccountRequestController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/request-akun', [AccountRequestController::class, 'create'])->name('account-request.create');
Route::post('/request-akun', [AccountRequestController::class, 'store'])->name('account-request.store');
Route::get('/request-akun/sukses', [AccountRequestController::class, 'success'])->name('account-request.success');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:admin,guru'])->group(function () {
        Route::resource('kegiatan', KegiatanController::class);
    });

    Route::middleware(['role:admin,guru'])->group(function () {
        Route::resource('peserta', PesertaController::class)->parameters(['peserta' => 'peserta']);
        Route::get('kegiatan/{kegiatan}/peserta', [PesertaController::class, 'byKegiatan'])->name('peserta.by-kegiatan');
        Route::post('peserta/import', [PesertaController::class, 'import'])->name('peserta.import');
    });

    Route::middleware(['role:admin,guru'])->group(function () {
        Route::get('sertifikat', [SertifikatController::class, 'index'])->name('sertifikat.index');
        Route::post('sertifikat/generate/{kegiatan}', [SertifikatController::class, 'generate'])->name('sertifikat.generate');
        Route::get('sertifikat/{sertifikat}/pdf', [SertifikatController::class, 'pdf'])->name('sertifikat.pdf');
        Route::delete('sertifikat/{sertifikat}', [SertifikatController::class, 'destroy'])->name('sertifikat.destroy');
    });

    Route::get('sertifikat/{sertifikat}/download', [SertifikatController::class, 'download'])->name('sertifikat.download');

    Route::middleware(['role:siswa'])->group(function () {
        Route::get('sertifikat-saya', [SertifikatController::class, 'milikSaya'])->name('sertifikat.milik-saya');
    });

    // Khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('template-sertifikat', TemplateSertifikatController::class);
        Route::get('account-requests', [AccountRequestController::class, 'index'])->name('account-request.index');
        Route::post('account-requests/{id}/approve', [AccountRequestController::class, 'approve'])->name('account-request.approve');
        Route::post('account-requests/{id}/reject', [AccountRequestController::class, 'reject'])->name('account-request.reject');
    });

});