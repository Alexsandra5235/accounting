<?php

namespace App\Services;

use App\Models\History;
use App\Models\Log\Log;
use Illuminate\Support\Facades\Auth;

class HistoryService
{
    public function diff(Log $afterLog, Log $beforeLog) : string
    {
        $differences = [];

        $relatedModels = [
            'log_receipt_id' => 'receipt',
            'log_discharge_id' => 'discharge',
            'log_reject_id' => 'reject',
            'patient_id' => 'patient',
        ];

        foreach ($relatedModels as $foreignKey => $relationship) {
            $beforeRelated = $beforeLog->$relationship;
            $afterRelated = $afterLog->$relationship;

            if ($beforeRelated && $afterRelated) {
                foreach ($afterRelated->getAttributes() as $key => $afterValue) {
                    if($key != 'updated_at'){
                        if ($key != 'id' && $afterValue != $beforeRelated->$key) {
                            $differences["$relationship.$key"] = "{$relationship}.$key: {$afterValue} -> {$beforeRelated->$key};";
                        }
                    }
                }
            }
        }
        return implode("", $differences);

    }
    public function store(Log $log) : History
    {
        return History::query()->create([
            'log_id' => $log->id,
            'user_id' => Auth::id(),
            'header' => 'Добавление новой записи о пациенте',
            'description' => "Имя пациента: {$log->patient->name}. Номер мед.карты: {$log->patient->medical_card}. Дата и время поступления: {$log->receipt->date_receipt} {$log->receipt->time_receipt}. В настоящий момент запись удалена."
        ]);
    }
    public function update(Log $afterLog, Log $beforeLog) : History
    {
        $result = $this->diff($afterLog, $beforeLog);
        return History::query()->create([
            'log_id' => $afterLog->id,
            'user_id' => Auth::id(),
            'header' => 'Редактирование данных в журнале',
            'description' => "Имя пациента: {$beforeLog->patient->name}. Номер мед.карты: {$beforeLog->patient->medical_card}. Дата и время поступления: {$beforeLog->receipt->date_receipt} {$beforeLog->receipt->time_receipt}. В настоящий момент запись удалена.",
            'diff' => $result,
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
