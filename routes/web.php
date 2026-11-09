<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Auth\DemoLoginController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/beranda', [PageController::class, 'home'])->name('home.alias');
Route::get('/profil-mahasiswa', [PageController::class, 'profile'])->name('profile');
Route::get('/mahasiswa/{nrp}', [PageController::class, 'profile'])
    ->whereNumber('nrp')
    ->name('mahasiswa.show');

Route::get('/ide-agent', [PageController::class, 'agent'])->name('agent.show');
Route::post('/ide-agent', [PageController::class, 'submitIdea'])->name('agent.submit');

Route::get('/hitung-ipk', [PageController::class, 'ipkForm'])->name('ipk.form');
Route::get('/hitung-ipk/{ip1}/{ip2}', [PageController::class, 'ipkCalculate'])
    ->where(['ip1' => '(?:[0-3](?:\\.[0-9]+)?|4(?:\\.0+)?)', 'ip2' => '(?:[0-3](?:\\.[0-9]+)?|4(?:\\.0+)?)'])
    ->name('ipk.calculate');

require __DIR__.'/auth.php';

Route::post('/demo-login/{role}', DemoLoginController::class)
    ->middleware('guest')
    ->name('demo.login');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:Admin|Staf'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('permission:view-dashboard')
            ->name('dashboard');

        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
            ->middleware('permission:view-mahasiswa')
            ->name('mahasiswa.index');

        Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])
            ->middleware('permission:delete-mahasiswa')
            ->name('mahasiswa.destroy');

        Route::get('/ubah-kata-sandi', [PasswordController::class, 'edit'])
            ->name('password.edit');
        Route::put('/ubah-kata-sandi', [PasswordController::class, 'update'])
            ->name('password.update');
    });

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
