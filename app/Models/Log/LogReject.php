<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogReject extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_id',
        'reason_refusal',
        'name_medical_worker',
        'add_info'
    ];
//    public function log() : BelongsTo
//    {
//        return $this->belongsTo(Log::class);
//    }
}
