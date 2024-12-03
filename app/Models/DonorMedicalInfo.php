<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonorMedicalInfo extends Model
{
    use HasFactory;

    protected $table = 'donor_medical_info';

    protected $fillable = [
        'user_id', 'organs_to_donate', 'blood_type', 'rh_factor',
        'preexisting_conditions', 'allergies', 'continuous_medication',
        'alcohol_consumer', 'smoker', 'family_history',
    ];

    public static function create(array $array)
    {
        return DonorMedicalInfo::query()->create($array);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
