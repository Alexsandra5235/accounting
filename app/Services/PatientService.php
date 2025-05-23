<?php

namespace App\Services;

use App\Models\Diagnosis;
use App\Models\Log\Log;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientService
{
    public function validate(Request $request) : array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'birth_day' => 'required|date',
            'gender' => 'required|string',
            'medical_card' => 'required|string',
            'passport' => 'nullable|string|min:6',
            'nationality' => 'nullable|string',
            'address' => 'nullable|string',
            'register_place' => 'nullable|string',
            'snils' => 'nullable|string',
            'polis' => 'nullable|string',
        ]);
    }
    public function store(Request $request,Diagnosis $diagnosis) : Patient
    {
        $validatedData = $this->validate($request);
        return Patient::query()->create(array_merge($validatedData, ['diagnosis_id' => $diagnosis->id]));
    }
    public function update(Request $request, Log $log) : void
    {
        $validatedData = $this->validate($request);
        $log->patient()->update($validatedData);
    }

}
