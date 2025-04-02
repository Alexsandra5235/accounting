<?php

namespace App\Services\Log;

use App\Models\Log\Log;
use App\Services\PatientService;
use Illuminate\Http\Request;

class LogService
{
    protected PatientService $patientService;
    protected LogReceiptService $logReceiptService;
    protected LogDischargeService $logDischargeService;
    protected LogRejectService $logRejectService;
    public function __construct(PatientService $patientService, LogReceiptService $logReceiptService,
                                LogDischargeService $logDischargeService, LogRejectService $logRejectService){

        $this->patientService = $patientService;
        $this->logReceiptService = $logReceiptService;
        $this->logDischargeService = $logDischargeService;
        $this->logRejectService = $logRejectService;
    }
    public function getForeign($request) : array
    {
        $patient_id = $this->patientService->store($request)->id;
        $log_receipt_id = $this->logReceiptService->store($request)->id;
        $log_discharge_id = $this->logDischargeService->store($request)->id;
        $log_reject_id = $this->logRejectService->store($request)->id;

        return [
            'patient_id' => $patient_id,
            'log_receipt_id' => $log_receipt_id,
            'log_discharge_id' => $log_discharge_id,
            'log_reject_id' => $log_reject_id
        ];
    }
    public function store(Request $request) : Log
    {
        $data = $this->getForeign($request);
        return Log::query()->create([
            'patient_id' => $data['patient_id'],
            'log_receipt_id' => $data['log_receipt_id'],
            'log_discharge_id' => $data['log_discharge_id'],
            'log_reject_id' => $data['log_reject_id'],
        ]);

    }
}
