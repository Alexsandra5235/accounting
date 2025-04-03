<?php

namespace App\Services\Log;

use App\Models\Log\Log;
use App\Models\Log\LogReceipt;
use Illuminate\Http\Request;

class LogReceiptService
{
    public function validate(Request $request) : array
    {
        return $request->validate([
            'date_receipt' => 'required|date',
            'time_receipt' => 'required|string',
            'datetime_alcohol' => 'nullable|date',
            'phone_agent' => 'nullable|string',
            'delivered' => 'nullable|string',
            'fact_alcohol' => 'nullable|string',
            'result_research' => 'nullable|string',
            'section_medical' => 'nullable|string',
        ]);
    }
    public function store(Request $request) : LogReceipt
    {
        $validatedData = $this->validate($request);
        return LogReceipt::query()->create($validatedData);
    }
    public function update(Request $request, Log $log) : void
    {
        $validatedData = $this->validate($request);
        $log->logReceipt()->update($validatedData);
    }
}
