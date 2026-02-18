<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInsuranceInfo extends Model
{
    
      use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_guardian_signature',
        'date',
        'insurance_provider',
        'insurance_plan',
        'insurance_policy_number',
        'insurance_contact_number',
        'insurance_group_number',
        'insurance_social_security',
        'relationship_policy_holder',
        'policy_holer_name',


       
      
    ];


        // Relationship
    public function patient()
    {
        return $this->belongsTo(PatientData::class, 'patient_id');
    }

}
