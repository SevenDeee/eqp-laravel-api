<?php

use App\Http\Controllers\PatientInformationController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/patients', [PatientInformationController::class, 'index']);
Route::get('/patients/{patient}', [PatientInformationController::class, 'show']);
Route::put('/patients/{patient}', [PatientInformationController::class, 'update']);
Route::post('/patients', [PatientInformationController::class, 'store']);
Route::post('/patients/{patient}/archive', [PatientInformationController::class, 'archive']);
Route::post('/patients/{patient}/restore', [PatientInformationController::class, 'restore']);

Route::post('patients/{patient}/prescription', [PrescriptionController::class, 'store']);
