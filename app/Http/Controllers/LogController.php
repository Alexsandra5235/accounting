<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function show($id) : object
    {
        return view('logShow')->with('log',Patient::query()->findOrFail($id));
    }

}
