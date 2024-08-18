<?php

use App\Http\Controllers\ClaimController;
use Illuminate\Support\Facades\Route;

Route::controller(ClaimController::class)->group(function () {
    Route::get('/', 'index')->name('claim.index');
    Route::post('/', 'store')->name('claim.store');
    Route::get('/download', 'downloadTemplate')->name('claim.download');
});
