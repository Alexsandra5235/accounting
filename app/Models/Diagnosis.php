<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diagnosis extends Model
{
    protected $fillable = ['state_id','wound_id'];
    public function state() : BelongsTo
    {
        return $this->belongsTo(Classifier::class, 'state_id');
    }

    public function wound() : BelongsTo
    {
        return $this->belongsTo(Classifier::class, 'wound_id');
    }
}
