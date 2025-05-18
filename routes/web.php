<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Front\Pkl\Index;

Route::get('/siswa', function () {
    return "Siswa Test";
})->middleware(['auth', 'verified','role:siswa','check_user_email'])
 ->name('siswa');

Route::get('/pkl', function () {
    return view('livewire.front.pkl.index');
})->middleware(['auth', 'verified','role:siswa','check_user_email'])
 ->name('pkl');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified','role:siswa','check_user_email'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
