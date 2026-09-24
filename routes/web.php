<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutMediaController;
use App\Http\Controllers\AboutContentController;

Route::view('/', 'home')->name('home');
Route::get('/home/media/{key}', [\App\Http\Controllers\HomeContentController::class, 'media'])->name('home.media');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/{blog:slug}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog/{blog:slug}', [BlogController::class, 'update'])->name('blog.update');
Route::delete('/blog/{blog:slug}', [BlogController::class, 'destroy'])->name('blog.destroy');

// Publications routes
Route::get('/publications', [PublicationController::class, 'index'])->name('publications.index');
Route::get('/publications/create', [PublicationController::class, 'create'])->name('publications.create');
Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');
Route::get('/publications/{publication}/edit', [PublicationController::class, 'edit'])->name('publications.edit');
Route::put('/publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');
Route::delete('/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');

// Static pages
Route::get('/about', [AboutContentController::class, 'show'])->name('about');
Route::get('/about/media/{kind}', [AboutMediaController::class, 'show'])->whereIn('kind', ['portrait', 'research', 'resume'])->name('about.media');
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home-content', [\App\Http\Controllers\HomeContentController::class, 'edit'])->name('home-content.edit');
    Route::put('/home-content', [\App\Http\Controllers\HomeContentController::class, 'update'])->name('home-content.update');
    Route::get('/about-content', [AboutContentController::class, 'edit'])->name('about-content.edit');
    Route::put('/about-content', [AboutContentController::class, 'update'])->name('about-content.update');
    Route::get('/about-media', [AboutMediaController::class, 'edit'])->name('about-media.edit');
    Route::put('/about-media', [AboutMediaController::class, 'update'])->name('about-media.update');
});
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
