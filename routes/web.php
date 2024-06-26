<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\Auth\ProviderController;



use App\Http\Controllers\ProfileController;
use Laravel\Socialite\Facades\Socialite;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/auth/{provider}/redirect', [ProviderController::class,'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class,'callback']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/fcm_token', [ProfileController::class, 'saveFcm'])->name('profile.saveFcm');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Livewire::setScriptRoute(function ($handle) {
        return Route::get('/marinoV2/public/livewire/livewire.js', $handle);
    });

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/marinoV2/public/livewire/update', $handle);
    });


Route::get('/dashboard', [GuestController::class, 'dashboard'])->middleware(['auth', 'verified'])
->name('dashboard');

Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/about-us', [GuestController::class, 'aboutUs'])->name('about-us');
Route::get('/products', [GuestController::class, 'products'])->name('products');
Route::get('/clients', [GuestController::class, 'clients'])->name('clients');
Route::get('/contact', [GuestController::class, 'contact'])->name('contact');
Route::post('/check', [GuestController::class, 'checkEmail'])->name('check-email');
Route::post('/request', [GuestController::class, 'requestLoad'])->name('request');
Route::post('/topup', [TopUpController::class, 'topup'])->middleware(['auth', 'verified'])->name('topup');
Route::post('/loadNow', [TopUpController::class, 'loadNow'])->middleware(['auth', 'verified'])->name('loadNow');
Route::get('/balance', [TopUpController::class, 'balance'])->middleware(['auth', 'verified'])->name('balance');


require __DIR__.'/auth.php';
