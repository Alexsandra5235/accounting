<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\Log\Log;
use App\Models\Patient;
use App\Services\Log\LogDischargeService;
use App\Services\Log\LogReceiptService;
use App\Services\Log\LogRejectService;
use App\Services\Log\LogService;
use App\Services\PatientService;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected LogService $logService;
    public function __construct(LogService $logService){

        $this->logService = $logService;
        $this->middleware('auth');
    }
    public function show($id) : object
    {
        return view('logShow')->with('log', Log::query()->findOrFail($id));
    }

    public function store(Request $request) : object
    {
        $log = $this->logService->store($request);
        if($log == null) return redirect()->back()->withErrors(['save_error' => 'Не удалось сохранить данные. Пожалуйста, попробуйте еще раз.']);

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
