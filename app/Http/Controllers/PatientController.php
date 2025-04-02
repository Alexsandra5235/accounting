<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected PatientService $patientService;
    public function __construct(PatientService $patientService){
        $this->patientService = $patientService;
        $this->middleware('auth');
    }

    public function store(Request $request) : object
    {
        $this->patientService->validate($request);

        return Patient::query()->create($request->all());
    }

    public function update(Request $request, $id) : object
    {
        $this->patientService->validate($request);

        $patient = Patient::query()->findOrFail($id);
        $patient->update($request->all());

        return $patient;
    }

    public function destroy($id) : void
    {
        $patient = Patient::query()->findOrFail($id);
        $patient->delete();

    }
}
