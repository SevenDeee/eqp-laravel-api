<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'max:255'],
            'sex' => ['required', 'string', 'max:255', 'in:Male,Female,Other'],
            'frame_type' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
            'lens_supply' => ['nullable', 'string', 'max:255'],
            'diagnosis' => ['nullable', 'string', 'max:255'],
            'special_instructions' => ['nullable', 'string', 'max:255'],
            'follow_up_on' => ['nullable', 'date'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'deposit' => ['nullable', 'numeric', 'min:0'],
            'balance' => ['nullable', 'numeric', 'min:0'],
            'created_by' => ['required', 'numeric'],
        ];
    }
}
