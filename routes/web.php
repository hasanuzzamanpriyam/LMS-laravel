<?php

use App\Http\Controllers\backend\adminController;
use App\Http\Controllers\backend\instructorController;
use App\Http\Controllers\backend\instructorProfileController;
use App\Http\Controllers\backend\adminProfileController;
use App\Http\Controllers\backend\categoryController;
use App\Http\Controllers\backend\subCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Admin Routes
Route::get('admin/login', [adminController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [adminController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [adminController::class, 'destroy'])->name('logout');

    // Admin profile routes
    Route::get('profile', [adminProfileController::class, 'index'])->name('profile');
    Route::post('profile/store', [adminProfileController::class, 'store'])->name('profile.store');
    Route::get('settings', [adminProfileController::class, 'settings'])->name('settings');
    Route::post('password/update', [adminProfileController::class, 'updatePassword'])->name('password.update');

    // category routes
    Route::resource('categories', categoryController::class);

    // sub category routes
    Route::resource('subcategories', subCategoryController::class);
});




// Instructor Routes
Route::get('instructor/login', [instructorController::class, 'login'])->name('instructor.login');

Route::middleware(['auth', 'verified', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
    Route::get('dashboard', [instructorController::class, 'dashboard'])->name('dashboard');
    Route::post('logout', [instructorController::class, 'destroy'])->name('logout');

    // instructor profile routes
    Route::get('profile', [instructorProfileController::class, 'index'])->name('profile');
    Route::post('profile/store', [instructorProfileController::class, 'store'])->name('profile.store');
    Route::get('settings', [instructorProfileController::class, 'settings'])->name('settings');
    Route::post('password/update', [instructorProfileController::class, 'updatePassword'])->name('password.update');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



Route::get('/say', function () {
    return "Hello World";
});
