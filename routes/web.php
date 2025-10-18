<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sales/{sale}/invoice', [SaleController::class, 'downloadInvoice'])
    ->name('sales.invoice.download');
