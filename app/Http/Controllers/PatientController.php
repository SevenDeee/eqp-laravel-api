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
    public function index(Request $request)
    {
        $patients = Patient::whereNull('archived_at')
            ->select('id', 'name', 'address', 'contact_number', 'age', 'follow_up_on', 'created_at')
            ->when(
                $request->search,
                fn($q, $search) =>
                $q->where(fn($q) => $q->where('name', 'like', "%{$search}%")
                    ->orWhere('contact_number', 'like', "%{$search}%"))
            )
            ->withCount('prescriptions')->latest()
            ->simplePaginate($request->get('per_page', 15))
            ->appends($request->query());

        return response()->json(['patients' => $patients]);
    }

    public function follow_up_list(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $patient = Patient::whereDate('follow_up_on', '>=', now())
            ->whereNull('archived_at')
            ->orderBy('follow_up_on')
            ->select('id', 'name', 'follow_up_on')
            ->simplePaginate($perPage);
        return response()->json($patient);
    }

    public function show(Patient $patient)
    {
        $patient->load('prescriptions')->orderByDesc('created_at');

        return response()->json([
            'message' => 'Patient information retrieved successfully.',
            'data' => $patient,
        ], 200);
    }

    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->validated());

        return response()->json([
            'message' => 'Patient information saved successfully.',
            'data' => $patient,
        ], 201);
    }

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
        $patient->update(['archived_at' => now()]);

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

    public function destroy(Patient $patient)
    {
        //
    }
}
