<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrescriptionRequest;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
{

    public function store(StorePrescriptionRequest $request)
    {

        $data = $request->validated();


        DB::beginTransaction();

        try {

            $prescription = Prescription::create($data);

            DB::commit();

            return response()->json([
                'message' => 'Prescription created successfully',
                'data' => $prescription
            ], 201);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create prescription',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
