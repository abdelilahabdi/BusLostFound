<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Admin\AnnouncementModerationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'active.user'])->name('dashboard');

Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])
    ->whereNumber('announcement')
    ->name('announcements.show');

Route::middleware(['auth', 'active.user'])->group(function () {
    Route::get('/my-announcements', [AnnouncementController::class, 'myAnnouncements'])->name('announcements.my');

    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])
        ->whereNumber('announcement')
        ->name('announcements.edit');
    Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])
        ->whereNumber('announcement')
        ->name('announcements.update');
    Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])
        ->whereNumber('announcement')
        ->name('announcements.destroy');
    Route::patch('/announcements/{announcement}/resolve', [AnnouncementController::class, 'markResolved'])
        ->whereNumber('announcement')
        ->name('announcements.resolve');
    Route::post('/announcements/{announcement}/reports', [ReportController::class, 'store'])
        ->whereNumber('announcement')
        ->name('announcements.reports.store');
    Route::post('/announcements/{announcement}/messages', [MessageController::class, 'store'])
        ->whereNumber('announcement')
        ->name('announcements.messages.store');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'active.user', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/announcements', [AnnouncementModerationController::class, 'index'])->name('announcements.index');
    Route::patch('/announcements/{announcement}/status', [AnnouncementModerationController::class, 'updateStatus'])
        ->whereNumber('announcement')
        ->name('announcements.status');
    Route::delete('/announcements/{announcement}', [AnnouncementModerationController::class, 'destroy'])
        ->whereNumber('announcement')
        ->name('announcements.destroy');

    Route::get('/reports', [ReportManagementController::class, 'index'])->name('reports.index');
    Route::patch('/reports/{report}/review', [ReportManagementController::class, 'markReviewed'])
        ->whereNumber('report')
        ->name('reports.review');

    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/toggle-active', [UserManagementController::class, 'toggleActive'])
        ->whereNumber('user')
        ->name('users.toggle-active');
});

require __DIR__.'/auth.php';
