<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
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
            // 'patient_information_id' => ['required', 'exists:patient_information,id'],
            'remarks' => ['nullable', 'string'],

            // Prescription JSON structure
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
        ];
    }
}
