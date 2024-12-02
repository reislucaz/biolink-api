<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorMedicalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'organs_to_donate', 'blood_type', 'rh_factor',
        'preexisting_conditions', 'allergies', 'continuous_medication',
        'alcohol_consumer', 'smoker', 'family_history',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
