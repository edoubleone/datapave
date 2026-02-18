<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalInfo extends Model
{
      use HasFactory;

    protected $fillable = [
        'patient_id',
        'have_you_had_the_following',
        'other_medical_problems',
        'previous_surgeries',
        'family_medical_history',
        'currently_smoke',
        'other_tobacco_products',
        'past_pregnancies',
        'allergies',
        'current_medications',
        'x-rays_and_injuries',
        'insurance_provider',
        'insurance_policy_number',
       
      
    ];

    protected $casts = [
        'have_you_had_the_following' => 'array',
        'other_medical_problems' => 'array',
        'previous_surgeries' => 'array',
        'family_medical_history' => 'array',
        'allergies' => 'array',
        'current_medications' => 'array',
         'x-rays_and_injuries' => 'array'
    ];

    // Relationship
    public function patient()
    {
        return $this->belongsTo(PatientData::class, 'patient_id');
    }
}
