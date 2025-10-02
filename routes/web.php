<?php

use Laravel\Fortify\Features;
use App\Livewire\Products\Index;
use App\Livewire\Products\Create;
use App\Livewire\Products\Update;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// Los full pages component siempre van a utilizar el layout principal app.blade.php (resources\views\components\layouts\app.blade.php)
Route::get('products', Index::class)->name('products.index');
Route::get('products/create', Create::class)->name('products.create');
Route::get('products/{product}/edit', Update::class)->name('products.edit');

require __DIR__.'/auth.php';
