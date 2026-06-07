<?php

use App\Http\Controllers\AuthControllerKAL;
use App\Http\Controllers\CategoryControllerKAL;
use App\Http\Controllers\DashboardControllerKAL;
use App\Http\Controllers\ProfileControllerKAL;
use App\Http\Controllers\ReminderControllerKAL;
use App\Http\Controllers\TaskControllerKAL;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthControllerKAL::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthControllerKAL::class, 'login']);
    Route::get('/register', [AuthControllerKAL::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthControllerKAL::class, 'register']);
});

Route::post('/logout', [AuthControllerKAL::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'log.kal'])->group(function () {
    Route::get('/dashboard', DashboardControllerKAL::class)->name('dashboard');
    Route::get('/profile', [ProfileControllerKAL::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileControllerKAL::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileControllerKAL::class, 'updatePassword'])->name('profile.password.update');
    Route::put('/settings/notifications', [ProfileControllerKAL::class, 'updateSettings'])->name('settings.notifications');
    Route::get('/notifications/settings', [ProfileControllerKAL::class, 'showNotificationSettings'])->name('notifications.settings');
    Route::get('/tasks/{task}/confirmation', [TaskControllerKAL::class, 'confirmation'])->name('tasks.confirmation');
    Route::get('/tasks/assigned', [TaskControllerKAL::class, 'assigned'])->name('tasks.assigned');
    Route::get('/admin/reminders', [ReminderControllerKAL::class, 'show'])
        ->middleware('role.kal:admin')
        ->name('reminders.form');

    Route::post('/reminders/deadlines', [ReminderControllerKAL::class, 'send'])
        ->middleware('role.kal:admin')
        ->name('reminders.deadlines');
    Route::post('/tasks/{task}/reminder', [ReminderControllerKAL::class, 'sendForTask'])
        ->middleware('role.kal:admin')
        ->name('reminders.task');
    Route::resource('tasks', TaskControllerKAL::class);
    Route::resource('categories', CategoryControllerKAL::class)->only(['index', 'store', 'destroy'])
        ->middleware('role.kal:admin,team_member');
    Route::resource('users', \App\Http\Controllers\UserControllerKAL::class)->only(['index', 'show', 'edit', 'update', 'destroy'])
        ->middleware('role.kal:admin');
});
