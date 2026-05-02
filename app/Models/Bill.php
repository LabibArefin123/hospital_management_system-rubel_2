<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'patient_id',
        'consultation_fee',
        'medicine_charge',
        'test_charge',
        'total_amount',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
