<?php

use App\Http\Controllers\HorecaController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Assign.unique.identifier makes sure it gets the assigned lane
Route::middleware(['assign.unique.identifier'])->group(function () {
    Route::get('/', [HorecaController::class, 'getCateringItems'])->name('horeca');
    Route::get('/order', [OrderController::class, 'getOrderWithUser'])->name('order');
});

// Sents the horeca orderdata to the orderpage
Route::post('/submit-order', [HorecaController::class, 'submitOrder'])->name('submit.order');
// Stores the orderdata on the orderpage in the database
Route::post('/store-order', [OrderController::class, 'store'])->name('store.order');
