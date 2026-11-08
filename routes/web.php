<?php

use App\Http\Controllers\Admin\AcademicResourceController as AdminAcademicResourceController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\AcademicResourceController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\StudentController;
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

Auth::routes(['verify' => true]);

/* CampusNotes public website */
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home')->name('frontend.home');
    Route::get('/features', 'features')->name('frontend.features');
    Route::get('/how-it-works', 'howItWorks')->name('frontend.how-it-works');
    Route::get('/about', 'about')->name('frontend.about');
    Route::get('/community', 'community')->name('frontend.community');
    Route::get('/contributors', 'contributors')->name('frontend.contributors');
    Route::get('/faq', 'faq')->name('frontend.faq');
});

/* Academic resource discovery — every menu has its own named route and Blade view. */
Route::get('/resources', [AcademicResourceController::class, 'index'])->name('resources.index');
Route::get('/resources/upload', [AcademicResourceController::class, 'uploadForm'])->middleware('auth')->name('resources.upload');
Route::post('/resources', [AcademicResourceController::class, 'store'])->middleware('auth')->name('resources.store');
Route::get('/resources/{resource:slug}', [AcademicResourceController::class, 'show'])->name('resources.show');
Route::get('/resources/{resource:slug}/download', [AcademicResourceController::class, 'download'])->name('resources.download');
Route::post('/resources/{resource}/bookmark', [AcademicResourceController::class, 'bookmark'])->middleware('auth')->name('resources.bookmark');
Route::post('/resources/{resource}/reviews', [AcademicResourceController::class, 'review'])->middleware('auth')->name('resources.review');
Route::get('/departments', [AcademicResourceController::class, 'departments'])->name('departments.index');
Route::get('/departments/{department:slug}', [AcademicResourceController::class, 'department'])->name('departments.show');
Route::get('/questions', [AcademicResourceController::class, 'questions'])->name('questions.index');
Route::get('/assignments', [AcademicResourceController::class, 'assignments'])->name('assignments.index');
Route::get('/contact', [ContactController::class, 'index'])->name('frontend.contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('frontend.contact.store');

/* Public SEO-friendly blog */
Route::get('/robots.txt', [BlogController::class, 'robots'])->name('blog.robots');
Route::get('/sitemap.xml', [BlogController::class, 'sitemap'])->name('blog.sitemap');
Route::get('/blog/feed.xml', [BlogController::class, 'feed'])->name('blog.feed');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

/* Student workspace */
Route::middleware('auth')->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookmarks', [StudentController::class, 'bookmarks'])->name('bookmarks');
});

/* Existing authenticated application home (admin workspace or student dashboard) */
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {
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

    Route::prefix('admin/contact-messages')->name('admin.contact-messages.')->group(function () {
        Route::get('/', [ContactMessageController::class, 'index'])->middleware('can:contact-messages-list')->name('index');
        Route::put('/{contactMessage}', [ContactMessageController::class, 'updateStatus'])->middleware('can:contact-messages-update')->name('update');
        Route::delete('/{contactMessage}', [ContactMessageController::class, 'destroy'])->middleware('can:contact-messages-delete')->name('destroy');
    });

    Route::prefix('admin/resources')->name('admin.resources.')->group(function () {
        Route::get('/', [AdminAcademicResourceController::class, 'index'])->middleware('can:resources-list')->name('index');
        Route::post('/{resource}/approve', [AdminAcademicResourceController::class, 'approve'])->middleware('can:resources-approve')->name('approve');
        Route::post('/{resource}/reject', [AdminAcademicResourceController::class, 'reject'])->middleware('can:resources-approve')->name('reject');
        Route::delete('/{resource}', [AdminAcademicResourceController::class, 'destroy'])->middleware('can:resources-delete')->name('destroy');
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
        Route::get('settings', [ProfileController::class, 'settings'])->name('settings.index');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});
