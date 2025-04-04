<?php

namespace App\Services\Log;

use App\Models\Log\Log;
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
    public function __construct(PatientService $patientService, LogReceiptService $logReceiptService,
                                LogDischargeService $logDischargeService, LogRejectService $logRejectService){

        $this->patientService = $patientService;
        $this->logReceiptService = $logReceiptService;
        $this->logDischargeService = $logDischargeService;
        $this->logRejectService = $logRejectService;
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
                $patient_id = $this->patientService->store($request)->id;
                $log = Log::query()->create([
                    'patient_id' => $patient_id,
                ]);
                $this->logReceiptService->store($request,$log);
                $this->logDischargeService->store($request,$log);
                $this->logRejectService->store($request,$log);

                return $log;
            });
        } catch (Exception $e) {
            return $e;
        }
    }
    public function update($request, $log) : Log | Exception
    {
        try {
            return DB::transaction(function () use ($request, $log) {
                $this->patientService->update($request, $log);
                $this->logReceiptService->update($request, $log);
                $this->logDischargeService->update($request, $log);
                $this->logRejectService->update($request, $log);

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
                $log->patient()->delete();
                return null;
            });
        } catch (Exception $e){
            return $e;
        }
    }
}
