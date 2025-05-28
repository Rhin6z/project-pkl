<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Front\Pkl\Index as PklIndex;
use App\Livewire\Front\Siswa\Index as SiswaIndex;
use App\Livewire\Front\Guru\Index as GuruIndex;
use App\Livewire\Front\Industri\Index as IndustriIndex;

Route::get('/siswa', SiswaIndex::class)
    ->middleware(['auth', 'verified','role:guru|admin','check_user_email'])
    ->name('siswa');

Route::get('/pkl', PklIndex::class)
    ->middleware(['auth', 'verified','role:guru|siswa|admin','check_user_email'])
    ->name('pkl');

Route::get('/guru', GuruIndex::class)
    ->middleware(['auth', 'verified','role:guru|admin','check_user_email'])
    ->name('guru');

Route::get('/industri', IndustriIndex::class)
    ->middleware(['auth', 'verified','role:guru|siswa|admin','check_user_email'])
    ->name('industri');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'role:guru|siswa|admin', 'check_user_email'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
