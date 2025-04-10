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

        $nameKey = [
            'receipt.date_receipt' => 'Дата поступления',
            'receipt.time_receipt' => 'Время поступления',
            'patient.name' => 'ФИО',
            'patient.birth_day' => 'Дата рождения',
            'patient.gender' => 'Пол',
            'patient.medical_card' => 'Мед.карта',
            'patient.passport' => 'Серия и номер паспорта',
            'patient.nationality' => 'Гражданство',
            'patient.address' => 'Регистрация по месту жительства',
            'patient.register_place' => 'Регистрация по месту пребывания',
            'receipt.phone_agent' => 'Номер телефона законного представителя',
            'patient.snils' => 'СНИСЛ',
            'patient.polis' => 'Полис ОМС',
            'receipt.delivered' => 'Пациент доставлен',
            'patient.diagnosis.state.code' => 'Диагноз заболевания (состояния)',
            'patient.diagnosis.wound.code' => 'Причина и обстоятельства травмы',
            'receipt.fact_alcohol' => 'Факт употребления алкоголя и иных психоактивных веществ',
            'receipt.datetime_alcohol' => 'Дата и время взятия пробы',
            'receipt.result_research' => 'Результаты лабораторных исследований',
            'receipt.section_medical' => 'Отделение медицинской организации, в которое направлен пациент',
            'discharge.outcome' => 'Исход госпитализации',
            'discharge.datetime_discharge' => 'Дата и время исхода',
            'discharge.section_transferred' => 'Наименование медицинской организации, куда переведен пациент',
            'discharge.datetime_inform' => 'Дата и время сообщения законному представителю о госпитализации',
            'reject.reason_refusal' => 'Причина отказа в госпитализации',
            'reject.name_medical_worker' => 'ФИО мед.работника',
            'reject.add_info' => 'Дополнительные сведения',
        ];

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
                            $differences["$relationship.$key"] = "{$nameKey["$relationship.$key"]}: {$beforeRelated->$key} -> {$afterValue};";
                        }
                    }
                }
                if($relationship === 'patient'){
                    foreach (['state','wound'] as $relation) {
                        $beforeRelated = $beforeLog->$relationship->diagnosis->$relation;
                        $afterRelated = $afterLog->$relationship->diagnosis->$relation;

                        foreach ($afterRelated->getAttributes() as $key => $afterValue) {
                            if($key != 'updated_at'){
                                if ($key != 'id' && $afterValue != $beforeRelated->$key) {
                                    $differences["$relationship.$key"] = "{$nameKey["$relationship.$key"]}: {$beforeRelated->$key} -> {$afterValue};";
                                }
                            }
                        }
                    }

                }
            }
        }
//        dd($afterLog, $beforeLog, $differences);
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
            'description' => "Имя пациента: {$afterLog->patient->name}. Номер мед.карты: {$afterLog->patient->medical_card}. Дата и время поступления: {$afterLog->receipt->date_receipt} {$afterLog->receipt->time_receipt}. В настоящий момент запись удалена.",
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
