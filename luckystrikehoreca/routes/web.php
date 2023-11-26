<?php

use App\Http\Controllers\CateringController;
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

Route::middleware(['assign.unique.identifier'])->group(function () {
    Route::get('/', [CateringController::class, 'getCateringItems']);
    Route::get('/order', [CateringController::class, 'getOrderWithUser']);
});

Route::post('/submit-order', [CateringController::class, 'submitOrder'])->name('submit_order');
