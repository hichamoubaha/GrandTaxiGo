<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\DriverAvailabilityController;

Route::middleware(['auth'])->group(function () {
    Route::get('trips', [TripController::class, 'index'])->name('trips.index');
    Route::post('trips', [TripController::class, 'store'])->name('trips.store');
    Route::get('trips/history', [TripController::class, 'history'])->name('trips.history');
    Route::post('trips/{trip}/accept', [TripController::class, 'accept'])->name('trips.accept');
    Route::post('trips/{trip}/reject', [TripController::class, 'reject'])->name('trips.reject');
    Route::post('trips/{trip}/cancel', [TripController::class, 'cancel'])->name('trips.cancel');
});


Route::middleware(['auth'])->group(function () {
    Route::get('trips', [TripController::class, 'index'])->name('trips.index');
    Route::post('trips', [TripController::class, 'store'])->name('trips.store');
    Route::get('trips/history', [TripController::class, 'history'])->name('trips.history');
    Route::post('trips/{trip}/accept', [TripController::class, 'accept'])->name('trips.accept');
    Route::post('trips/{trip}/cancel', [TripController::class, 'cancel'])->name('trips.cancel');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('drivers/availability', DriverAvailabilityController::class)->except(['edit', 'update', 'show']);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('trips', TripController::class)->except(['edit', 'update', 'show']);
});

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
Route::get('register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('register', [UserController::class, 'register']);
Route::get('trip/reserve', [TripController::class, 'showReserveForm'])->name('trip.reserve');
Route::post('trip/reserve', [TripController::class, 'reserveTrip']);
Route::post('driver/availability', [DriverAvailabilityController::class, 'updateAvailability'])->name('driver.availability');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
