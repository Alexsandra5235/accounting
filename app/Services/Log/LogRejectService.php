<?php

namespace App\Services\Log;

use App\Models\Log\Log;
use App\Models\Log\LogDischarge;
use App\Models\Log\LogReject;
use Illuminate\Http\Request;

class LogRejectService
{
    public function validate(Request $request) : array
    {
        return $request->validate([
            'reason_refusal' => 'nullable|string|max:255',
            'name_medical_worker' => 'nullable|string|max:255',
            'add_info' => 'nullable|string|max:255',
        ]);
    }
    public function store(Request $request) : LogReject
    {
        $validatedData = $this->validate($request);
        return LogReject::query()->create($validatedData);
    }
    public function update(Request $request, Log $log) : void
    {
        $validatedData = $this->validate($request);
        $log->logReject()->update($validatedData);
    }
}
