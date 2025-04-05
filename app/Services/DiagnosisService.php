<?php

namespace App\Services;

use App\Models\Classifier;
use App\Models\Diagnosis;

class DiagnosisService
{
    public function store(Classifier $state, Classifier $wound) : Diagnosis
    {
        return Diagnosis::query()->create([
            'state_id' => $state->id,
            'wound_id' => $wound->id,
        ]);
    }
}
