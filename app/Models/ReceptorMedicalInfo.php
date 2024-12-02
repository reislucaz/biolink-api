<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptorMedicalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'blood_type', 'rh_factor', 'health_problems',
        'medical_history', 'transplant_history', 'required_organ',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
