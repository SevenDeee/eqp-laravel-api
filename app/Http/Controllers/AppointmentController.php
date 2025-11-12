<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
    public function store(StoreAppointmentRequest $request)
    {
        // $data = Appointment::create($request->validated());
        $data = $request->validated();

        return response()->json(['data' => $data]);
    }
}
