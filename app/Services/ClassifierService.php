<?php

namespace App\Services;

use App\Models\Classifier;
use App\Models\Log\Log;
use Illuminate\Http\Request;

class ClassifierService
{
    public function storeState(Request $request) : Classifier
    {
        return Classifier::query()->create([
            'code' => $request->input('state_code'),
            'value' => $request->input('state_value'),
            ]);
    }
    public function storeWound(Request $request) : Classifier
    {
        return Classifier::query()->create([
            'code' => $request->input('wound_code'),
            'value' => $request->input('wound_value'),
        ]);
    }
    public function updateState(Request $request, Log $log) : Classifier
    {
        return $log->patient()->diagnosis()->state()->update([
            'code' => $request->input('state_code'),
            'value' => $request->input('state_value'),
        ]);
    }
    public function updateWound(Request $request, Log $log) : Classifier
    {
        return $log->patient->diagnosis->wound()->update([
            'code' => $request->input('wound_code'),
            'value' => $request->input('wound_value'),
        ]);
    }
}
