<?php

use App\Http\Controllers\ClaimController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::controller(ClaimController::class)->group(function () {
    Route::get('/', 'index')->name('claim.index');
    Route::post('/', 'store')->name('claim.store');
    Route::get('/download', 'downloadTemplate')->name('claim.download');
});

Route::controller(SubmissionController::class)->group(function () {
    Route::get('/submission', 'index')->name('submission.index');
    Route::post('/submisson', 'store')->name('submission.store');
    Route::get('/submission/download', 'downloadTemplate')->name('submission.download');
});
