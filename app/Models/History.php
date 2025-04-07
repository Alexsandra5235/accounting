<?php

namespace App\Models;

use App\Models\Log\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    protected $fillable = [
        'user_id',
        'log_id',
        'header',
        'description',
        'diff',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function log() : BelongsTo
    {
        return $this->belongsTo(Log::class , 'log_id');
    }
}
