<?php

namespace App\Models;

use App\Models\Log\Log;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'name',
        'birth_day',
        'gender',
        'passport',
        'nationality',
        'address',
        'register_place',
        'snils',
        'polis',
        'medical_card',
    ];

    protected array $dates = [
        'birth_day'
    ];
    public function log() : BelongsTo
    {
        return $this->belongsTo(Log::class);
    }
}
