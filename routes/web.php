<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Admin\Blog\BlogPostController;
use App\Http\Controllers\Admin\Blog\BlogCategoryController;
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

/* Public SEO-friendly blog */
Route::get('/robots.txt', [BlogController::class, 'robots'])->name('blog.robots');
Route::get('/sitemap.xml', [BlogController::class, 'sitemap'])->name('blog.sitemap');
Route::get('/blog/feed.xml', [BlogController::class, 'feed'])->name('blog.feed');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

/* Existing authenticated application home */
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

Route::middleware('auth')->group(function () {
    /* Blog CMS: existing Spatie blog permissions are reused. */
    Route::prefix('admin/blog')->name('admin.blog.')->group(function () {
        Route::get('/posts', [BlogPostController::class, 'index'])->middleware('can:blog-list')->name('posts.index');
        Route::get('/posts/create', [BlogPostController::class, 'create'])->middleware('can:blog-create')->name('posts.create');
        Route::post('/posts', [BlogPostController::class, 'store'])->middleware('can:blog-create')->name('posts.store');
        Route::post('/upload-inline-image', [BlogPostController::class, 'uploadInlineImage'])->name('upload-inline-image');
        Route::get('/posts/{post}/edit', [BlogPostController::class, 'edit'])->middleware('can:blog-edit')->name('posts.edit');
        Route::put('/posts/{post}', [BlogPostController::class, 'update'])->middleware('can:blog-edit')->name('posts.update');
        Route::delete('/posts/{post}', [BlogPostController::class, 'destroy'])->middleware('can:blog-delete')->name('posts.destroy');

        Route::get('/categories', [BlogCategoryController::class, 'index'])->middleware('can:blog-list')->name('categories.index');
        Route::post('/categories', [BlogCategoryController::class, 'store'])->middleware('can:blog-create')->name('categories.store');
        Route::get('/categories/{category}/edit', [BlogCategoryController::class, 'edit'])->middleware('can:blog-edit')->name('categories.edit');
        Route::put('/categories/{category}', [BlogCategoryController::class, 'update'])->middleware('can:blog-edit')->name('categories.update');
        Route::delete('/categories/{category}', [BlogCategoryController::class, 'destroy'])->middleware('can:blog-delete')->name('categories.destroy');
    });
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
