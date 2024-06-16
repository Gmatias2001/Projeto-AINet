<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\RedirectResponse;

// REPLACE THIS
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

//WITH THIS
Route::get('/', [MovieController::class, 'index']);
Route::get('/movieslist', [MovieController::class, 'lista']);
Route::get('/movie/{id}', [MovieController::class, 'details']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tickets/purchase', [TicketController::class, 'showPurchasePage'])->name('tickets.purchase');       //
Route::post('/tickets/purchase', [TicketController::class, 'purchaseTicket'])->name('tickets.purchase.post');   //
Route::get('/tickets/success/{ticket}', [TicketController::class, 'showSuccessPage'])->name('tickets.success'); //






Route::get('/movieslist/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');



require __DIR__.'/auth.php';


