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
            'passport' => 'string|min:6',
            'nationality' => 'string',
            'address' => 'string',
            'register_place' => 'string',
            'snils' => 'string',
            'polis' => 'string',
            'medical_card' => 'required|string',
        ]);
    }
}
