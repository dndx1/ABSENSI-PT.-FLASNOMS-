<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ReplicationLogController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboard;
use App\Http\Controllers\Employee\AttendanceController;

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Redirect after login (role based)
|--------------------------------------------------------------------------
*/
Route::get('/redirect', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/employee/dashboard');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:employee'])->prefix('employee')->group(function () {
    Route::get('/dashboard', [EmployeeDashboard::class, 'index'])
        ->name('employee.dashboard');

    Route::post('/attendance', [AttendanceController::class, 'store'])
        ->name('attendance.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])
        ->name('admin.dashboard');
    
    Route::get('/replication-log', [ReplicationLogController::class, 'index'])
        ->name('admin.replication-log');
});

require __DIR__.'/auth.php';