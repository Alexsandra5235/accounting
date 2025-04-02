<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogReceipt extends Model
{
    use HasFactory;

    protected $table = 'log_receipts';

    protected $fillable = [
        'date_receipt',
        'datetime_alcohol',
        'time_receipt',
        'phone_agent',
        'delivered',
        'fact_alcohol',
        'result_research',
        'section_medical',
    ];
}
