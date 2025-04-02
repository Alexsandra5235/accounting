<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\Patient;

class LogController extends Controller
{
    public function show($id) : object
    {
        return view('logShow')->with('log',Patient::query()->findOrFail($id));
    }

}
