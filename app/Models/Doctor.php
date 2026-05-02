<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'is_available',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
