<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInformation extends Model
{
    /** @use HasFactory<\Database\Factories\PatientInformationFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'follow_up_on' => 'datetime',
        'archived_at' => 'datetime',
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'patient_id');
    }
}
