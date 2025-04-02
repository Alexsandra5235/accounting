<?php

namespace App\Services\Log;

use Illuminate\Http\Request;

class LogReceiptService
{
    public function validate(Request $request) : array
    {
        return $request->validate([
            'date_receipt' => 'required|date',
            'datetime_alcohol' => 'date',
            'time_receipt' => 'required|string',
            'phone_agent' => 'phone',
        ]);
    }
}
