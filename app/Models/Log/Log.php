<?php

namespace App\Models\Log;

use App\Models\Log\LogDischarge;
use App\Models\Log\LogReceipt;
use App\Models\Log\LogReject;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Log extends Model
{
    protected static function booted() : void
    {
        static::deleting(function ($log) {
            $log->patient->diagnosis->state->delete();
            $log->patient->diagnosis->wound->delete();
            $log->receipt->delete();
            $log->discharge->delete();
            $log->reject->delete();
        });
    }
    protected $fillable = [
        'patient_id',
        'log_receipt_id',
        'log_discharge_id',
        'log_reject_id'
    ];
    public function receipt() : BelongsTo
    {
        return $this->belongsTo(LogReceipt::class, 'log_receipt_id');
    }

    public function discharge() : BelongsTo
    {
        return $this->belongsTo(LogDischarge::class, 'log_discharge_id');
    }

    public function reject() : BelongsTo
    {
        return $this->belongsTo(LogReject::class, 'log_reject_id');
    }

    public function patient() : BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
