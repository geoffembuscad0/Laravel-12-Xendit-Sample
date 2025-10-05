<?php

use App\Http\Controllers\Checkout\CheckoutController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [
    CheckoutController::class,
    'index'
]);

Route::get('/try-checkout', [
    CheckoutController::class,
    'onSubmit'
]);
