<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

/* Public website pages */
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home')->name('frontend.home');
    Route::get('/features', 'features')->name('frontend.features');
    Route::get('/how-it-works', 'howItWorks')->name('frontend.how-it-works');
    Route::get('/about', 'about')->name('frontend.about');
    Route::get('/contact', 'contact')->name('frontend.contact');
});

/* Existing authenticated application home */
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::prefix('admin')->group(function () {
        Route::get('manage-permissions', [RolePermissionController::class, 'managePermissions'])->name('manage_permissions');
        Route::get('roles/{role}/permissions', [RolePermissionController::class, 'getPermissions'])->name('get_permissions');
        Route::post('roles/{role}/permissions', [RolePermissionController::class, 'updatePermissions'])->name('update_permissions');

        Route::prefix('dashboard')->group(function () {
            Route::get('/', [TodoController::class, 'index'])->name('dashboard');
            Route::post('/', [TodoController::class, 'store'])->name('todo.store');
            Route::get('/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
            Route::put('/{id}', [TodoController::class, 'update'])->name('todo.update');
            Route::delete('/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
        });

        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    });
});
