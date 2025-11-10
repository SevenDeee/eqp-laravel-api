<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Patient::whereNull('archived_at')
            ->select('id', 'name', 'address', 'contact_number', 'age', 'created_at')
            ->withCount('prescriptions')
            ->orderBy('created_at')
            ->get();

        $years = Patient::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return response()->json([$data, $years]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load('prescriptions')->orderByDesc('created_at');

        return response()->json([
            'message' => 'Patient information retrieved successfully.',
            'data' => $patient,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->validated());

        return response()->json([
            'message' => 'Patient information saved successfully.',
            'data' => $patient,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        return response()->json([
            'message' => 'Patient updated successfully',
            'data' => $patient
        ], 200);
    }

    public function follow_up(Request $request, Patient $patient)
    {

        $validated = $request->validate([
            'follow_up_on' => 'nullable|date'
        ]);
        $patient->update($validated);

        return response()->json([
            'message' => 'Follow-up updated successfully.',
            'data' => $patient,
        ], 200);
    }

    public function archive(Patient $patient)
    {
        $patient->update([
            'archived_at' => now(),
        ]);

        return response()->json([
            'message' => 'Patient archived successfully.',
            'data' => $patient,
        ], 200);
    }

    public function restore(Patient $patient)
    {
        $patient->update([
            'archived_at' => null,
        ]);

        return response()->json([
            'message' => 'Patient restored successfully.',
            'data' => $patient,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
