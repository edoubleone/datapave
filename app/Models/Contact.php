<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
     use HasFactory;

     protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'appointment_time',
        'appointment_date',
        'message',
    ];

    // Make appointment fields optional
    protected $attributes = [
        'appointment_time' => null,
        'appointment_date' => null,
        'last_name' => '',
    ];
}