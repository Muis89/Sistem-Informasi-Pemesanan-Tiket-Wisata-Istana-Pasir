<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:pengunjung'])->prefix('visitor')->name('visitor.')->group(function () {
    Route::get('/dashboard', [VisitorController::class, 'dashboard'])->name('dashboard');
    Route::get('/book', [VisitorController::class, 'book'])->name('book');
    Route::post('/book', [VisitorController::class, 'storeBooking'])->name('book.store');
    Route::get('/checkout/{pemesanan}', [VisitorController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/{pemesanan}/payment', [VisitorController::class, 'uploadPayment'])->name('payment.upload');
    Route::get('/ticket/{pemesanan}', [VisitorController::class, 'ticket'])->name('ticket');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets');
    Route::post('/tickets', [AdminController::class, 'storeTicket'])->name('tickets.store');
    Route::put('/tickets/{tiket}', [AdminController::class, 'updateTicket'])->name('tickets.update');
    Route::delete('/tickets/{tiket}', [AdminController::class, 'destroyTicket'])->name('tickets.destroy');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::patch('/bookings/{pemesanan}/status', [AdminController::class, 'updateBookingStatus'])->name('bookings.status');
    Route::delete('/bookings/{pemesanan}', [AdminController::class, 'destroyBooking'])->name('bookings.destroy');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
    Route::get('/payments/{pembayaran}/proof', [AdminController::class, 'paymentProof'])->name('payments.proof');
    Route::patch('/payments/{pembayaran}', [AdminController::class, 'verifyPayment'])->name('payments.verify');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/scan', [PetugasController::class, 'scan'])->name('scan');
    Route::post('/verify', [PetugasController::class, 'verify'])->name('verify');
});

Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('dashboard');
});
