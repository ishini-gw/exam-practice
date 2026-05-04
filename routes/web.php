<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Books\ListBooks;
use App\Livewire\Books\Create;
use App\Livewire\Books\Edit;
use App\Livewire\Books\View;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


Route::group(['prefix' => 'livewire', 'middleware' => ['auth']], function () {
   
     Route::group(['prefix' => 'books'], function () {
        Route::get('/', ListBooks::class)->name('books.index');
        Route::get('/create', Create::class)->name('livewire.books.create');
        Route::get('/edit/{id}', Edit::class)->name('livewire.books.edit');
        Route::get('/view/{id}', View::class)->name('livewire.books.view');
       
     
    });
});

require __DIR__.'/auth.php';
