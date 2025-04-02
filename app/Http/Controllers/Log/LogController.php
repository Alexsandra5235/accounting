<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\Log\Log;
use App\Models\Patient;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function show($id) : object
    {
        return view('logShow')->with('log',Patient::query()->findOrFail($id));
    }

    public function store(Request $request) : object
    {

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'log_receipt_id' => 'required|exists:log_receipts,id',
            'log_discharge_id' => 'nullable|exists:log_discharges,id',
            'log_reject_id' => 'nullable|exists:log_rejects,id',
        ]);

        Log::query()->create($request->all());

        return redirect()->to('/home');
    }

    public function update(Request $request, $id) : object
    {
        $log = Log::all()->findOrFail($id);

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'log_receipt_id' => 'required|exists:log_receipts,id',
            'log_discharge_id' => 'nullable|exists:log_discharges,id',
            'log_reject_id' => 'nullable|exists:log_rejects,id',
        ]);

        $log->update($request->all());

        return redirect()->to('/home');
    }

    public function destroy($id) : object
    {
        $log = Log::all()->findOrFail($id);
        $log->delete();

        return redirect()->to('/home');
    }

    public function index() : object
    {
        return view('log');
    }

//    public function show($id)
//    {
//        $log = Log::findOrFail($id);
//        return response()->json($log);
//    }

}
