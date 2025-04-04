<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogReceipt extends Model
{
    use HasFactory;

    protected $table = 'log_receipts';

    protected $fillable = [
        'log_id',
        'date_receipt',
        'datetime_alcohol',
        'time_receipt',
        'phone_agent',
        'delivered',
        'fact_alcohol',
        'result_research',
        'section_medical',
    ];

    protected array $dates = [
        'date_receipt',
        'datetime_alcohol'
    ];
    public function log() : BelongsTo
    {
        return $this->belongsTo(Log::class);
    }
}
