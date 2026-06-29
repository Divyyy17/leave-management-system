<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveController;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/leaves', [LeaveController::class, 'allLeaves']);
});
/*
|--------------------------------------------------------------------------
| Authenticated (Employee)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Leave system (IMPORTANT: NAMED ROUTES)
    Route::get('/leave/apply', [LeaveController::class, 'create'])->name('leave.apply');
    Route::post('/leave/apply', [LeaveController::class, 'store'])->name('leave.store');
    Route::get('/my-leaves', [LeaveController::class, 'myLeaves'])->name('leave.my');
});

/*
|--------------------------------------------------------------------------
| Manager
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'manager'])->group(function () {

    Route::get('/manager/leaves', [LeaveController::class, 'allLeaves'])
        ->name('manager.leaves');

    Route::post('/manager/leaves/{id}/approve', [LeaveController::class, 'approve'])
        ->name('leave.approve');

    Route::post('/manager/leaves/{id}/reject', [LeaveController::class, 'reject'])
        ->name('leave.reject');
});

require __DIR__.'/auth.php';