<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CartController;

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
Route::get('/movie/{movie}/{date}/ticket/purchase', [TicketController::class, 'showPurchasePage'])->name('tickets.purchase');
Route::post('/movie/{movie}/{screening}/ticket/purchase', [TicketController::class, 'purchaseTicket'])->name('tickets.purchase.post');

Route::delete('/cart/{ticket}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart', [CartController::class, 'confirm'])->name('cart.confirm');
Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/cart/checkout', [CartController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');

Route::get('/cart/checkout', [CartController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');

Route::get('/cart/checkout/visa', [CartController::class, 'visaForm'])->name('visa.form');
Route::get('/cart/checkout/paypal', [CartController::class, 'paypalForm'])->name('paypal.form');
Route::get('/cart/checkout/mbway', [CartController::class, 'mbwayForm'])->name('mbway.form');

// Rotas para processar os pagamentos
Route::post('/visa/process', [CartController::class, 'processVisa'])->name('visa.process');
Route::post('/paypal/process', [CartController::class, 'processPaypal'])->name('paypal.process');
Route::post('/mbway/process', [CartController::class, 'processMbway'])->name('mbway.process');



Route::middleware(['web'])->group(function () {
    Route::get('movieslist/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('movieslist/{id}', [MovieController::class, 'update'])->name('movies.update');
});

Route::get('movieslist/create', [MovieController::class, 'create'])->name('movies.create'); ;
 
Route::post('/movieslist', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movieslist', [MovieController::class, 'list'])->name('movies.index');
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('movieslist/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('movieslist/{id}', [MovieController::class, 'update'])->name('movies.update');

Route::delete('movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

Route::get('movies/{movie}', [MovieController::class, 'show'])->name('movies.show'); 



require __DIR__.'/auth.php';


