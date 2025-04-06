<?php

namespace App\Services\Log;

use App\Models\Log\Log;
use App\Services\ClassifierService;
use App\Services\DiagnosisService;
use App\Services\HistoryService;
use App\Services\PatientService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogService
{
    protected PatientService $patientService;
    protected LogReceiptService $logReceiptService;
    protected LogDischargeService $logDischargeService;
    protected LogRejectService $logRejectService;
    protected ClassifierService $classifierService;
    protected DiagnosisService $diagnosisService;
    protected HistoryService $historyService;
    public function __construct(PatientService $patientService, LogReceiptService $logReceiptService,
                                LogDischargeService $logDischargeService, LogRejectService $logRejectService,
                                ClassifierService $classifierService, DiagnosisService $diagnosisService,
                                HistoryService $historyService){

        $this->patientService = $patientService;
        $this->logReceiptService = $logReceiptService;
        $this->logDischargeService = $logDischargeService;
        $this->logRejectService = $logRejectService;
        $this->classifierService = $classifierService;
        $this->diagnosisService = $diagnosisService;
        $this->historyService = $historyService;
    }

    public function validate(Request $request) : void
    {
        $this->patientService->validate($request);
        $this->logReceiptService->validate($request);
        $this->logDischargeService->validate($request);
        $this->logRejectService->validate($request);
    }
    public function store($request) : Log | Exception
    {
        try {
            return DB::transaction(function () use ($request) {
                $state = $this->classifierService->storeState($request);
                $wound = $this->classifierService->storeWound($request);
                $diagnosis = $this->diagnosisService->store($state, $wound);

                $patient = $this->patientService->store($request,$diagnosis);

                $log_receipt = $this->logReceiptService->store($request);
                $log_discharge = $this->logDischargeService->store($request);
                $log_reject = $this->logRejectService->store($request);

                $log = Log::query()->create([
                    'patient_id' => $patient->id,
                    'log_receipt_id' => $log_receipt->id,
                    'log_discharge_id' => $log_discharge->id,
                    'log_reject_id' => $log_reject->id
                ]);

                $this->historyService->store($log);
                return $log;

            });
        } catch (Exception $e) {
            return $e;
        }
    }
    public function update(Request $request, Log $log) : Log | Exception
    {
        try {
            return DB::transaction(function () use ($request, $log) {

                $this->classifierService->updateState($request, $log);
                $this->classifierService->updateWound($request, $log);
                $this->patientService->update($request, $log);
                $this->logReceiptService->update($request, $log);
                $this->logDischargeService->update($request, $log);
                $this->logRejectService->update($request, $log);

                $log->updated_at = now();
                $log->save();
                return $log;
            });

        } catch (Exception $e){
            return $e;
        }
    }
    public function destroy($id) : null | Exception
    {
        try{
            return DB::transaction(function () use ($id) {
                $log = Log::query()->findOrFail($id);
                $log->delete();
                return null;
            });
        } catch (Exception $e){
            return $e;
        }
    }
}
