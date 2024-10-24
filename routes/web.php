<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\instructorController;
use App\Http\Middleware\instructor;
use App\Http\Middleware\Role;

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

require __DIR__ . '/auth.php';




// Admin Dashboard
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [adminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [adminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [adminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [adminController::class, 'Store'])->name('admin.profile.store');
    Route::get('/admin/profile/AdminChangePassword', [adminController::class, 'AdminChangePassword'])->name('admin.profile.ChangePassword');
    Route::post('/admin/profile/AdminpasswordUpdate', [adminController::class, 'adminPasswordUpdate'])->name('admin.password.update');
});

Route::get('/admin/login', [adminController::class, 'AdminLogin'])->name('admin.login');


// Instructor Dashboard
Route::middleware(['auth', 'verified', 'instructor'])->group(function () {
    Route::get('/instructor/dashboard', [instructorController::class, 'InstructorDashboard'])->name('instructor');

    Route::get('/instructor/profile', [instructorController::class, 'InstructorProfile'])->name('instructor.profile');
    Route::get('/instructor/profile/instructorChangePassword', [instructorController::class, 'InstructorChangePassword'])->name('instructor.profile.ChangePassword');
    Route::post('/instructor/profile/passwordUpdate', [instructorController::class, 'instructorPasswordUpdate'])->name('instructor.password.update');

    Route::get('/instructor/logout', [instructorController::class, 'InstructorlogOut'])->name('instructor.logout');
    Route::post('/instructor/profile/store', [instructorController::class, 'Store'])->name('instructor.profile.store');

});

Route::get('/instructor/login', [instructorController::class, 'InstructorLogin'])->name('instructor.login');


// user or Student Dashboard
Route::get('/user/dashboard', [userController::class, 'UserDashboard'])->middleware(['auth', 'verified', 'user'])->name('user');
