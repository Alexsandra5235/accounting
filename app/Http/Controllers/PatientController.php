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
    }
    // переход на страницу добавления данных
    public function index() : object
    {
        $patients = Patient::all();
        return view('log')->with('patients', $patients);
    }

    public function store(Request $request) : object
    {
        $this->patientService->validate($request);

        Patient::query()->create($request->all());
        return redirect()->to('/home');
    }

    public function update(Request $request, $id) : object
    {
        $this->patientService->validate($request);

        $patient = Patient::query()->findOrFail($id);
        $patient->update($request->all());

        return redirect()->to('/home');
    }

    public function destroy($id) : object
    {
        $patient = Patient::query()->findOrFail($id);
        $patient->delete();

        return redirect()->to('/home');
    }
}
