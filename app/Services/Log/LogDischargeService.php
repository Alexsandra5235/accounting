<?php

namespace App\Services\Log;

use App\Models\Log\LogDischarge;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogDischargeService
{
    public function validate(Request $request): array
    {
        return $request->validate([
            'datetime_discharge' => 'nullable|date',
            'datetime_inform' => 'nullable|date',
            'outcome' => 'nullable|string|max:255',
            'section_transferred' => 'nullable|string|max:255',
        ]);
    }
    public function store(Request $request) : LogDischarge
    {
        $validatedData = $this->validate($request);
        return LogDischarge::query()->create($validatedData);
    }
}
