<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/categorias', [FrontendController::class, 'categories'])->name('frontend.categories');
Route::get('/produtos', [FrontendController::class, 'products'])->name('frontend.products');
Route::get('/produto/{product}', [FrontendController::class, 'product'])->name('frontend.product');
Route::get('/categoria/{category}', [FrontendController::class, 'category'])->name('frontend.category');
Route::get('/sobre', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/historia', [FrontendController::class, 'history'])->name('frontend.history');
Route::get('/noticias', [FrontendController::class, 'news'])->name('frontend.news');
Route::get('/noticias/{news:slug}', [FrontendController::class, 'newsShow'])->name('frontend.news.show');
Route::get('/contato', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::post('/contato', [FrontendController::class, 'submitContact'])->name('frontend.contact.submit');

Route::get('/locale/{locale}', LocaleController::class)->name('locale.switch');

// Redirect dashboard to admin (Filament)
Route::get('/dashboard', function () {
    return redirect()->route('filament.admin.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
