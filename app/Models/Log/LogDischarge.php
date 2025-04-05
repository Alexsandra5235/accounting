<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogDischarge extends Model
{
    use HasFactory;

    protected $table = 'log_discharges';

    protected $fillable = [
        'datetime_discharge',
        'datetime_inform',
        'outcome',
        'section_transferred',
    ];

    protected array $dates = [
        'datetime_discharge',
        'datetime_inform',
    ];

}
