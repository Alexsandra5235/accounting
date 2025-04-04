<?php

namespace App\Models\Log;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'patient_id',
    ];

    public function patient() : BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function logReceipt(): HasMany
    {
        return $this->hasMany(LogReceipt::class, 'log_id');
    }

    public function logDischarge() : HasMany
    {
        return $this->hasMany(LogDischarge::class, 'log_id');
    }

    public function logReject() : HasMany
    {
        return $this->hasMany(LogReject::class);
    }
}
