<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Route;

Route::post('patients/prescription', [PrescriptionController::class, 'store']);

Route::controller(PatientController::class)->group(function () {
    Route::get('/patients', 'index');
    Route::get('/patients/{patient}', 'show');
    Route::post('/patients', 'store');
    Route::put('/patients/{patient}', 'update');
    Route::post('/patients/{patient}/follow-up', 'follow_up');
    Route::post('/patients/{patient}/archive', 'archive');
    Route::post('/patients/{patient}/restore', 'restore');
});

/**
 * For POST, PUT method add these headers
 * 
 * Accept: application/json
 * Content-Type: application/json
 */
