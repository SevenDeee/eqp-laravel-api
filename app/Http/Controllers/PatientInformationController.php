<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientInformationRequest;
use App\Models\PatientInformation;

class PatientInformationController extends Controller
{

    public function index()
    {
        $data = PatientInformation::whereNull('archived_at')->get();

        return response()->json($data);
    }

    public function show($patient)
    {
        $data = PatientInformation::where('id', $patient)
            ->whereNull('archived_at')
            ->firstOrFail();

        return response()->json([
            'message' => 'Patient information retrieved successfully.',
            'data' => $data,
        ], 200);
    }

    public function store(StorePatientInformationRequest $request)
    {
        $data = $request->validated();

        $patient = PatientInformation::create($data);

        return response()->json([
            'message' => 'Patient information saved successfully.',
            'data' => $patient,
        ], 201);
    }

    public function update(StorePatientInformationRequest $request, PatientInformation $patient)
    {
        $data = $request->validated();

        $patient->update($data);

        return response()->json([
            'message' => 'Patient information updated successfully.',
            'data' => $patient,
        ]);
    }

    public function archive(PatientInformation $patient)
    {

        $patient->update([
            'archived_at' => now(),
        ]);

        return response()->json([
            'message' => 'Patient information archived successfully.',
            'data' => $patient,
        ], 200);
    }

    public function restore(PatientInformation $patient)
    {
        $patient->update([
            'archived_at' => null,
        ]);

        return response()->json([
            'message' => 'Patient information restored successfully.',
            'data' => $patient,
        ], 200);
    }
}
