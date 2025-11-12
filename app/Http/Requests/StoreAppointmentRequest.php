<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'appointment_date' => ['required', 'date_format:Y-m-d H:i:s'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $this->validateClinicHours($validator);
            $this->validateAppointmentConflicts($validator);
            $this->validateTimeSlotInterval($validator);
        });
    }

    protected function validateClinicHours($validator)
    {
        $start = Carbon::parse($this->appointment_date);

        // Example: Only allow appointments between 9:00 and 17:00
        if ($start->hour < 9 || $start->hour >= 17) {
            $validator->errors()->add('appointment_date', 'Appointments can only be scheduled between 9:00 AM and 5:00 PM.');
        }

        // Example: Block weekends
        if ($start->isWeekend()) {
            $validator->errors()->add('appointment_date', 'Appointments cannot be scheduled on weekends.');
        }
    }

    protected function validateAppointmentConflicts($validator)
    {
        $start = Carbon::parse($this->appointment_date);
        $end = $start->copy()->addMinutes(90);

        $conflict = Appointment::where(function ($query) use ($start, $end) {
            $query->whereBetween('appointment_date', [$start, $end]);
        })->exists();

        if ($conflict) {
            $validator->errors()->add('appointment_date', 'This time slot is already booked.');
        }
    }

    protected function validateTimeSlotInterval($validator)
    {
        $time = Carbon::parse($this->appointment_date);

        // Allow only slots that start on the hour or half-hour (optional)
        if (!in_array($time->minute, [0, 30])) {
            $validator->errors()->add('appointment_date', 'Appointments must start on the hour or half-hour.');
        }
    }
}
