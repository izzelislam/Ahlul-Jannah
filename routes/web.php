<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('home');
Route::get('/profil', [App\Http\Controllers\LandingController::class, 'profil'])->name('landing.profil');
Route::get('/program', [App\Http\Controllers\LandingController::class, 'program'])->name('landing.program');
Route::get('/galeri', [App\Http\Controllers\LandingController::class, 'galeri'])->name('landing.galeri');
Route::get('/kontak', [App\Http\Controllers\LandingController::class, 'kontak'])->name('landing.kontak');
Route::get('/pendaftaran', [App\Http\Controllers\LandingController::class, 'pendaftaran'])->name('landing.pendaftaran');
Route::get('/pendaftaran/formulir', [App\Http\Controllers\LandingController::class, 'pendaftaranForm'])->name('landing.pendaftaran.form');
Route::post('/pendaftaran/formulir', [App\Http\Controllers\LandingController::class, 'pendaftaranStore'])->name('landing.pendaftaran.store');

Route::get('/blog', [App\Http\Controllers\LandingController::class, 'blog'])->name('landing.blog');
Route::get('/blog/{slug}', [App\Http\Controllers\LandingController::class, 'blogDetail'])->name('landing.blog.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // User Management Routes
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/users/{user}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('users.delete');

    // Gallery Management Routes
    Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class);
    Route::resource('programs', App\Http\Controllers\Admin\ProgramController::class);

    // Post Category Management Routes
    Route::resource('post-categories', App\Http\Controllers\Admin\PostCategoryController::class);

    // Post Management Routes
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);

    // Structural Management Routes
    Route::resource('structurals', App\Http\Controllers\Admin\StructuralController::class);

    // Page Management Routes
    Route::get('/pages/edit-slug/{slug}', [App\Http\Controllers\Admin\PageController::class, 'editBySlug'])->name('pages.edit_by_slug');
    Route::resource('pages', App\Http\Controllers\Admin\PageController::class);

    // Profile Routes
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');

    // Settings Routes
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/reset', [App\Http\Controllers\Admin\SettingController::class, 'reset'])->name('settings.reset');

    // PPDB - Students Management
    Route::patch('/students/{student}/status', [App\Http\Controllers\Admin\StudentController::class, 'updateStatus'])->name('students.updateStatus');
    Route::resource('students', App\Http\Controllers\Admin\StudentController::class)->except(['create', 'store']);

    // PPDB - Academic Years Management
    Route::resource('academic-years', App\Http\Controllers\Admin\AcademicYearController::class);
});

require __DIR__.'/auth.php';
