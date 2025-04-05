<?php

namespace App\Services;

use App\Models\Classifier;
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
}
