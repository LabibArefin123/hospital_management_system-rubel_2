<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'speciality',
        'image',
        'success_rate',
        'experience_years',
        'total_patients',
        'qualification',
        'location',
        'consultation_fee',
        'availability',
        'about',
    ];
}