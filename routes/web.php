<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

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

Route::get('/', function () {
    return view('welcome');
});
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/marinoV2/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/marinoV2/public/livewire/update', $handle);
});


Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/about-us', [GuestController::class, 'aboutUs'])->name('about-us');
Route::get('/products', [GuestController::class, 'products'])->name('products');
Route::get('/clients', [GuestController::class, 'clients'])->name('clients');
Route::get('/contact', [GuestController::class, 'contact'])->name('contact');
