<?php

namespace App\Services;

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
}
