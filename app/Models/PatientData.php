<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PatientData extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'home_phone',
        'mobile_phone',
        'email',
        'emergency_contact',
        'contact_relationship',
        'emergency_contact_phone',
        'marital_status',
        'current_address',
        'about_us',
        'preferred_pharmacy_address',
        'reason_for_visit',
        'ethnicity',
        'race',

        
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'ethnicity' => 'array',
        'race' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Relationships
 
    public function medicalInfo()
    {
        return $this->hasOne(PatientMedicalInfo::class, 'patient_id');
    }
    public function insuranceInfo()
    {
        return $this->hasOne(PatientInsuranceInfo::class, 'patient_id');
    }
}
