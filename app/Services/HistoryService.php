<?php

namespace App\Services;

use App\Models\History;
use App\Models\Log\Log;
use Illuminate\Support\Facades\Auth;

class HistoryService
{
    public function store(Log $log) : History
    {
        return History::query()->create([
            'log_id' => $log->id,
            'user_id' => Auth::id(),
            'type' => 'Добавление новой записи о пациенте'
        ]);
    }
    public function update(Log $log) : History
    {
        return History::query()->create([
            'log_id' => $log->id,
            'user_id' => Auth::id(),
            'type' => 'Редактирование данных в журнале'
        ]);
    }
}
