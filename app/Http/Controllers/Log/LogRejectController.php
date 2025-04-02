<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\Log\LogReject;
use Illuminate\Http\Request;

class LogRejectController extends Controller
{
    public function store(Request $request) : object
    {
        $request->validate([
            'reason_refusal' => 'nullable|string|max:255',
            'name_medical_worker' => 'nullable|string|max:255',
            'add_info' => 'nullable|string|max:255',
        ]);

        return LogReject::query()->create($request->all());

    }

    public function update(Request $request, $id) : object
    {
        $logReject = LogReject::all()->findOrFail($id);

        $request->validate([
            'reason_refusal' => 'nullable|string|max:255',
            'name_medical_worker' => 'nullable|string|max:255',
            'add_info' => 'nullable|string|max:255',
        ]);

        $logReject->update($request->all());

        return $logReject;
    }

    public function destroy($id) : void
    {
        $logReject = LogReject::all()->findOrFail($id);
        $logReject->delete();
    }
}
