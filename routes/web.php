<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampusNotesController;

Route::get('/', [CampusNotesController::class, 'home'])->name('home');
Route::get('/resources', [CampusNotesController::class, 'resources'])->name('resources.index');
Route::get('/resources/create', [CampusNotesController::class, 'create'])->name('resources.create');
Route::post('/resources', [CampusNotesController::class, 'store'])->name('resources.store');
Route::get('/resources/{resource}', [CampusNotesController::class, 'show'])->name('resources.show');
Route::get('/resources/{resource}/download', [CampusNotesController::class, 'download'])->name('resources.download');
Route::get('/dashboard', [CampusNotesController::class, 'dashboard'])->name('dashboard');
Route::post('/demo-role', [CampusNotesController::class, 'switchRole'])->name('demo.role');
Route::post('/resources/{resource}/moderate', [CampusNotesController::class, 'moderate'])->name('resources.moderate');
Route::get('/departments', [CampusNotesController::class, 'departments'])->name('departments.index');
Route::post('/departments', [CampusNotesController::class, 'storeDepartment'])->name('departments.store');
