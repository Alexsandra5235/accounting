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
            'passport' => 'required|string|min:6',
            'nationality' => 'required|string',
            'address' => 'required|string',
            'register_place' => 'required|string',
            'snils' => 'required|string',
            'polis' => 'required|string',
            'medical_card' => 'required|string',
        ]);
    }
}
