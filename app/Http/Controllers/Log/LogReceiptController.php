<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\Log\LogReceipt;
use App\Services\Log\LogReceiptService;
use Illuminate\Http\Request;

class LogReceiptController extends Controller
{
    protected LogReceiptService $logReceiptService;

    public function __construct(LogReceiptService $logReceiptService){
        $this->logReceiptService = $logReceiptService;
        $this->middleware('auth');
    }

    public function store(Request $request) : void
    {
        $validatedData = $request->validate([
            'date_receipt' => 'required|date',
            'time_receipt' => 'required|string',
            'datetime_alcohol' => 'nullable|date',
            'phone_agent' => 'nullable|string',
            'delivered' => 'nullable|string',
            'fact_alcohol' => 'nullable|string',
            'result_research' => 'nullable|string',
            'section_medical' => 'nullable|string',
        ]);

        LogReceipt::query()->create($validatedData);

    }

    public function update(Request $request, LogReceipt $logReceipt) : void
    {
        $validatedData = $request->validate([
            'date_receipt' => 'sometimes|required|date',
            'datetime_alcohol' => 'sometimes|nullable|date',
            'time_receipt' => 'sometimes|required|string',
            'phone_agent' => 'sometimes|nullable|string',
            'delivered' => 'sometimes|nullable|boolean',
            'fact_alcohol' => 'sometimes|nullable|string',
            'result_research' => 'sometimes|nullable|string',
            'section_medical' => 'sometimes|nullable|string',
        ]);

        $logReceipt->update($validatedData);

    }

    public function destroy($id) : void
    {
        $logReceipt = LogReceipt::all()->findOrFail($id);
        $logReceipt->delete();

    }
}
