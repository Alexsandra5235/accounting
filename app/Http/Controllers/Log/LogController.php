<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use App\Models\Log\Log;
use App\Models\Patient;
use App\Services\Log\LogDischargeService;
use App\Services\Log\LogReceiptService;
use App\Services\Log\LogRejectService;
use App\Services\Log\LogService;
use App\Services\PatientService;
use Exception;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;

class LogController extends Controller
{
    protected LogService $logService;
    public function __construct(LogService $logService){

        $this->logService = $logService;
        $this->middleware('auth');
    }
    public function show($id) : object
    {
        return view('logShow')->with('log', Log::query()->findOrFail($id));
    }

    public function store(Request $request) : object
    {
        $this->logService->validate($request);
        $log = $this->logService->store($request);
        if($log instanceof Exception) return redirect()
            ->back()
            ->withErrors(['save_error' => "Не удалось сохранить данные. Пожалуйста, попробуйте еще раз. Исключение: $log"]);

        return redirect()->to('/home');
    }

    public function update(Request $request, $id) : object
    {
        $beforeLog = Log::query()->findOrFail($id);
        $log = $this->logService->update($request, $beforeLog);

        if($log::class === Exception::class) return redirect()->back()
            ->withErrors(['save_error' => "Не удалось обновить данные. Пожалуйста, попробуйте еще раз.
            Исключение: $log"]);

        return redirect()->to('/home');
    }
    public function edit($id) : object
    {
        return view('logEdit')->with('log', Log::query()->findOrFail($id));
    }

    public function destroy($id) : object
    {
        $result = $this->logService->destroy($id);
        if($result == null) redirect()->to('/home');

        return redirect()->to('/home')->withErrors(['destroy_error' => "Не удалось удалить данные. Исключение: $result"]);
    }

    public function index() : object
    {
        return view('log');
    }

}
