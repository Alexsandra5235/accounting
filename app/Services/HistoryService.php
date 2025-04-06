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
            'header' => 'Добавление новой записи о пациенте',
            'description' => "Имя пациента: {$log->patient->name}. Номер мед.карты: {$log->patient->medical_card}. Дата и время поступления: {$log->receipt->date_receipt} {$log->receipt->time_receipt}. В настоящий момент запись удалена."
        ]);
    }
    public function update(Log $log) : History
    {
        return History::query()->create([
            'log_id' => $log->id,
            'user_id' => Auth::id(),
            'header' => 'Редактирование данных в журнале',
            'description' => "Имя пациента: {$log->patient->name}. Номер мед.карты: {$log->patient->medical_card}. Дата и время поступления: {$log->receipt->date_receipt} {$log->receipt->time_receipt}. В настоящий момент запись удалена."
        ]);
    }
    public function destroy(Log $log) : History
    {
        return History::query()->create([
            'log_id' => $log->id,
            'user_id' => Auth::id(),
            'header' => 'Удаление данных из журнала',
            'description' => "Имя пациента: {$log->patient->name}. Номер мед.карты: {$log->patient->medical_card}. Дата и время поступления: {$log->receipt->date_receipt} {$log->receipt->time_receipt}."
        ]);
    }
}
