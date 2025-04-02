<?php

namespace App\Http\Controllers;

use App\Models\LogReceipt;
use App\Services\LogReceiptService;
use Illuminate\Http\Request;

class LogReceiptController extends Controller
{
    protected LogReceiptService $logReceiptService;

    public function __construct(LogReceiptService $logReceiptService){
        $this->logReceiptService = $logReceiptService;
        $this->middleware('auth');
    }

    public function store(Request $request) : object
    {
        $validatedData = $request->validate([
            'date_receipt' => 'required|date',
            'datetime_alcohol' => 'date',
            'time_receipt' => 'required|string',
            'phone_agent' => 'string',
            'delivered' => 'string',
            'fact_alcohol' => 'string',
            'result_research' => 'string',
            'section_medical' => 'string',
        ]);

        LogReceipt::query()->create($validatedData);

        return redirect()->to('/home');
    }

    // Метод для редактирования существующей записи
    public function update(Request $request, LogReceipt $logReceipt) : object
    {
        $validatedData = $request->validate([
            'date_receipt' => 'sometimes|required|date',
            'date_time_alcohol' => 'sometimes|required|date',
            'string_time_receipt' => 'sometimes|required|string',
            'number_phone_representative' => 'sometimes|required|string',
            'delivered' => 'sometimes|required|boolean',
            'fact_alcohol' => 'sometimes|required|string',
            'result_research' => 'sometimes|required|string',
            'department_medical_organization' => 'sometimes|required|string',
        ]);

        $logReceipt->update($validatedData);

        return redirect()->to('/home');
    }

    public function destroy(LogReceipt $logReceipt) : object
    {
        $logReceipt->delete();

        return redirect()->to('/home'); // Возвращаем пустой ответ с кодом 204
    }
}
