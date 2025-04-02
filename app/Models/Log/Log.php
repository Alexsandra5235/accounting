<?php

namespace App\Models\Log;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'patient_id',
        'log_receipt_id',
        'log_discharge_id',
        'log_reject_id',
    ];

    public function patient() : BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function logReceipt() : BelongsTo
    {
        return $this->belongsTo(LogReceipt::class, 'log_receipt_id');
    }

    public function logDischarge() : BelongsTo
    {
        return $this->belongsTo(LogDischarge::class, 'log_discharge_id');
    }

    public function logReject() : BelongsTo
    {
        return $this->belongsTo(LogReject::class, 'log_reject_id');
    }
}
