<?php

namespace App\Http\Controllers;

use App\Models\Patient;

class NotificationController extends Controller
{
    public function patient_follow_up()
    {
        $patients = Patient::whereDate('follow_up_on', now())
            ->select('id', 'name', 'follow_up_on')->get();

        $patientCount = $patients->count();

        $message = match (true) {
            $patientCount === 0 => "No follow-up appointments scheduled for today.",
            $patientCount === 1 => "1 follow-up is scheduled for today.",
            default => "There are $patientCount follow-ups scheduled for today."
        };

        return response()->json(['message' => $message, 'data' => $patients]);
    }
}
