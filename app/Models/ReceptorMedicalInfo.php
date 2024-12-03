<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceptorMedicalInfo extends Model
{
    use HasFactory;

    protected $table = 'receptor_medical_info';

    protected $fillable = [
        'user_id', 'blood_type', 'rh_factor', 'health_problems',
        'medical_history', 'transplant_history', 'required_organ',
    ];

    public static function create(array $array)
    {
        return ReceptorMedicalInfo::query()->create($array);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
