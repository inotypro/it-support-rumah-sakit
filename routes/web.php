<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Authentication Routes
Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Registration Routes
Route::prefix('registrations')->name('registrations.')->group(function () {
    Route::get('/select-type', [RegistrationController::class, 'selectType'])->name('select-type');
    Route::get('/create', [RegistrationController::class, 'create'])->name('create');
    Route::post('/', [RegistrationController::class, 'store'])->name('store');
    Route::get('/success', [RegistrationController::class, 'success'])->name('success');
    Route::get('/', [RegistrationController::class, 'index'])->name('index');
});

// Ticket Routes
Route::prefix('tickets')->name('tickets.')->group(function () {
    Route::get('/create', [TicketController::class, 'create'])->name('create');
    Route::post('/', [TicketController::class, 'store'])->name('store');
    Route::get('/success', [TicketController::class, 'success'])->name('success');
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/{ticket}', [TicketController::class, 'show'])->name('show');
});

// Survey Routes
Route::prefix('surveys')->name('surveys.')->group(function () {
    Route::get('/create', [SurveyController::class, 'create'])->name('create');
    Route::post('/', [SurveyController::class, 'store'])->name('store');
    Route::get('/success', [SurveyController::class, 'success'])->name('success');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Dashboard untuk semua admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Routes untuk superadmin dan admin pendaftaran
    Route::middleware(['role:superadmin,admin_pendaftaran'])->group(function () {
        // Registrations Management
        Route::prefix('registrations')->name('registrations.')->group(function () {
            Route::get('/', [RegistrationController::class, 'adminIndex'])->name('index');
            Route::get('/search', [RegistrationController::class, 'adminSearch'])->name('search');
            Route::get('/{registration}', [RegistrationController::class, 'show'])->name('show');
            Route::get('/{registration}/edit', [RegistrationController::class, 'edit'])->name('edit');
            Route::put('/{registration}', [RegistrationController::class, 'adminUpdate'])->name('update');
            Route::delete('/{registration}', [RegistrationController::class, 'adminDestroy'])->name('destroy');
            Route::put('/{registration}/status', [RegistrationController::class, 'updateStatus'])->name('update-status');
        });

        // Tickets Management
        Route::prefix('tickets')->name('tickets.')->group(function () {
            Route::get('/', [TicketController::class, 'adminIndex'])->name('index');
            Route::get('/search', [TicketController::class, 'adminSearch'])->name('search');
            Route::get('/{ticket}', [TicketController::class, 'adminShow'])->name('show');
            Route::get('/{ticket}/edit', [TicketController::class, 'adminEdit'])->name('edit');
            Route::put('/{ticket}', [TicketController::class, 'adminUpdate'])->name('update');
            Route::delete('/{ticket}', [TicketController::class, 'adminDestroy'])->name('destroy');
            Route::put('/{ticket}/status', [TicketController::class, 'updateStatus'])->name('status.update');
        });
    });

    // Routes khusus superadmin
    Route::middleware(['role:superadmin'])->group(function () {
        // Survey Management
        Route::prefix('surveys')->name('surveys.')->group(function () {
            Route::get('/', [SurveyController::class, 'adminIndex'])->name('index');
            Route::get('/search', [SurveyController::class, 'adminSearch'])->name('search');
            Route::get('/export', [SurveyController::class, 'export'])->name('export');
            Route::get('/{survey}', [SurveyController::class, 'adminShow'])->name('show');
            Route::delete('/{survey}', [SurveyController::class, 'adminDestroy'])->name('destroy');
        });
    });
});
