<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientInformationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'contact_number' => ['nullable', 'string', 'max:50'],
            'age' => ['nullable', 'integer', 'min:0'],
            'sex' => ['nullable', 'string', 'in:Male,Female,Other'],

            'prescription' => ['nullable', 'array'],
            'prescription.far.od.sphere' => ['nullable', 'string'],
            'prescription.far.od.cylinder' => ['nullable', 'string'],
            'prescription.far.od.axis' => ['nullable', 'string'],
            'prescription.far.od.monopd' => ['nullable', 'string'],

            'prescription.far.os.sphere' => ['nullable', 'string'],
            'prescription.far.os.cylinder' => ['nullable', 'string'],
            'prescription.far.os.axis' => ['nullable', 'string'],
            'prescription.far.os.monopd' => ['nullable', 'string'],

            'prescription.near.od.sphere' => ['nullable', 'string'],
            'prescription.near.od.cylinder' => ['nullable', 'string'],
            'prescription.near.od.axis' => ['nullable', 'string'],
            'prescription.near.od.monopd' => ['nullable', 'string'],

            'prescription.near.os.sphere' => ['nullable', 'string'],
            'prescription.near.os.cylinder' => ['nullable', 'string'],
            'prescription.near.os.axis' => ['nullable', 'string'],
            'prescription.near.os.monopd' => ['nullable', 'string'],

            'frame_type' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'lens_supply' => ['nullable', 'string'],
            'diagnosis' => ['nullable', 'string'],

            'amount' => ['nullable', 'numeric'],
            'deposit' => ['nullable', 'numeric'],
            'balance' => ['nullable', 'numeric'],

            'special_instructions' => ['nullable', 'string'],
            'follow_up_on' => ['nullable', 'date'],
        ];
    }
}
