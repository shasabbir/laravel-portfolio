<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ContactController;

Route::view('/', 'home')->name('home');

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
Route::view('/about', 'about')->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
