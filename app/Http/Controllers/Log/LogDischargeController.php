<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\Log\LogDischarge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogDischargeController extends Controller
{
    public function store(Request $request) : object
    {
        $validator = Validator::make($request->all(), [
            'datetime_discharge' => 'nullable|date',
            'datetime_inform' => 'nullable|date',
            'outcome' => 'nullable|string|max:255',
            'section_transferred' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return LogDischarge::query()->create($request->all());
    }

    public function update(Request $request, $id) : object
    {
        $logDischarge = LogDischarge::all()->find($id);

        if (!$logDischarge) {
            return redirect()->back()->withErrors('Log Discharge not found');
        }

        $validator = Validator::make($request->all(), [
            'datetime_discharge' => 'sometimes|nullable|date',
            'datetime_inform' => 'sometimes|nullable|date',
            'outcome' => 'sometimes|nullable|string|max:255',
            'section_transferred' => 'sometimes|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $logDischarge->update($request->all());

        return $logDischarge;
    }

    public function destroy($id) : void
    {
        $logDischarge = LogDischarge::all()->find($id);

        if (!$logDischarge) return;

        $logDischarge->delete();
    }
}
