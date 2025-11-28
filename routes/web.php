<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

// HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// BOOKS
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');   // <-- here
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// SELLER
Route::get('/sell', [SellerController::class,'create'])->name('seller.create');
Route::post('/sell', [SellerController::class,'store'])->name('seller.store');

// CART
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/increment/{bookId}', [CartController::class, 'increment'])->name('cart.increment');
Route::post('/cart/decrement/{bookId}', [CartController::class, 'decrement'])->name('cart.decrement');
Route::delete('/cart/remove/{bookId}', [CartController::class, 'remove'])->name('cart.remove');

// CHECKOUT / ORDERS
Route::get('/checkout', [OrderController::class,'checkoutForm'])->name('checkout.form');
Route::post('/checkout', [OrderController::class,'placeOrder'])->name('checkout.place');
Route::get('/orders', [OrderController::class,'index'])->name('orders.index');

// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
