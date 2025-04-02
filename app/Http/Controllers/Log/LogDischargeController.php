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
            'datetime_discharge' => 'date',
            'datetime_inform' => 'date',
            'outcome' => 'string|max:255',
            'section_transferred' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        LogDischarge::query()->create($request->all());

        return redirect()->to('/home');
    }

    public function update(Request $request, $id) : object
    {
        $logDischarge = LogDischarge::all()->find($id);

        if (!$logDischarge) {
            return redirect()->back()->withErrors('Log Discharge not found');
        }

        $validator = Validator::make($request->all(), [
            'datetime_discharge' => 'sometimes|date',
            'datetime_inform' => 'sometimes|date',
            'outcome' => 'sometimes|string|max:255',
            'section_transferred' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $logDischarge->update($request->all());

        return redirect()->to('/home');
    }

    public function destroy($id) : object
    {
        $logDischarge = LogDischarge::all()->find($id);

        if (!$logDischarge) {
            return redirect()->back()->withErrors('Log Discharge not found');
        }

        $logDischarge->delete();

        return redirect()->to('/home');
    }
}
