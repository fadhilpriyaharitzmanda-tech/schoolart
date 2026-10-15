<?php

use App\Http\Controllers\AiTutorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\MataPelajaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// ─── Modul Kurikulum SMK (Tahap 2) ───
Route::prefix('kurikulum')->name('kurikulum.')->group(function () {
    Route::get('/', [KurikulumController::class, 'index'])->name('index');
    Route::get('/{gradeLevel:slug}', [KurikulumController::class, 'show'])->name('show');
    Route::get('/{gradeLevel:slug}/{subject:slug}', [MataPelajaranController::class, 'show'])->name('mapel.show');
});

// ─── Sistem Penjadwalan Sekolah (Tahap 3) ───
Route::prefix('jadwal')->name('jadwal.')->group(function () {
    Route::get('/', [JadwalController::class, 'index'])->name('index');
    Route::get('/active', [JadwalController::class, 'currentActive'])->name('active');
});

// ─── AI Chatbot & Tutor Pintar SMK (Tahap 4) ───
Route::prefix('ai-tutor')->name('ai.')->group(function () {
    Route::get('/', [AiTutorController::class, 'index'])->name('index');
    Route::post('/chat', [AiTutorController::class, 'chat'])->name('chat');
});
