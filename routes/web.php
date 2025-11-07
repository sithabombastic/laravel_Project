<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// // View Profile Nav
// Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
// // Profile update (PUT)
// Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// // Photo delete (POST)
// Route::post('/profile/photo/delete', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
// // AutoSave Profile Image
// Route::post('/profile/photo-upload', [ProfileController::class, 'uploadPhoto'])->name('profile.photo.upload');

//Use this instead
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/photo-delete', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
Route::post('/profile/photo-upload', [ProfileController::class, 'uploadPhoto'])->name('profile.photo.upload');

// Login/Logout routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (requires authentication)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Categories (Item Master)
    Route::resource('categories', CategoryController::class);

    // Reports (placeholder)
    Route::get('/reports', function () {
        return 'Reports page';
    })->name('reports.index');
});


// This is Frontend Route
Route::get('/items', [FrontendController::class, 'showItems']);

//Search Item
Route::get('/items', [FrontendController::class, 'index'])->name('items.index');
Route::get('/items/search', [FrontendController::class, 'search'])->name('items.search');

