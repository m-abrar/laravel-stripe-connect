<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// routes/web.php

use App\Http\Controllers\StripeConnectController;

Route::get('/connect', [StripeConnectController::class, 'redirectToStripe'])->name('stripe.connect');
Route::get('/connect/callback', [StripeConnectController::class, 'handleCallback'])->name('stripe.callback');
