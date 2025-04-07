<?php

namespace App\Services;

use App\Models\Classifier;
use App\Models\Log\Log;
use Illuminate\Http\Request;

class ClassifierService
{
    public function validate(Request $request): array
    {
        return $request->validate([
            'state_code' => 'nullable',
            'state_value' => 'nullable',
            'wound_code' => 'nullable',
            'wound_value' => 'nullable',
        ]);
    }
    public function storeState(Request $request) : Classifier
    {
        $validatedData = $this->validate($request);
        return Classifier::query()->create([
            'code' => $validatedData['state_code'],
            'value' => $validatedData['state_value'],
        ]);
    }
    public function storeWound(Request $request) : Classifier
    {
        $validatedData = $this->validate($request);
        return Classifier::query()->create([
            'code' => $validatedData['wound_code'],
            'value' => $validatedData['wound_value'],
        ]);
    }
    public function updateState(Request $request, Log $log) : Classifier
    {
        $validatedData = $this->validate($request);
        $log->patient->diagnosis->state->code = $validatedData['state_code'];
        $log->patient->diagnosis->state->value = $validatedData['state_value'];
        $log->patient->diagnosis->state->save();


        return $log->patient->diagnosis->state;

    }
    public function updateWound(Request $request, Log $log) : Classifier
    {
        $validatedData = $this->validate($request);
        $log->patient->diagnosis->wound->code = $validatedData['wound_code'];
        $log->patient->diagnosis->wound->value = $validatedData['wound_value'];
        $log->patient->diagnosis->wound->save();

        return $log->patient->diagnosis->wound;
    }
}
