@extends('layouts.template')

@section('title')
    Просмотр информации о пользователе
@endsection

@section('content')
    <div class="container">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="padding-right: 14px">Главная</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page" style="padding-left: 0">Просмотр записи пациента</li>
                    </ol>
                </nav>
                <h5 class="card-title mb-2">Полная информация по пациенту <span class="h5" style="color: dodgerblue">{{ $log->patient->name }}</span></h5>
                <p class="card-text mb-1">Дата и время создания записи: {{ $log->created_at }}</p>

                <p class="card-text mb-1" style="margin-bottom: 8px">Дата и время последнего редактирования записи: {{ $log->created_at }}</p>
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary me-4" href="{{ route('log.edit', ['id'=>$log->id]) }}">Редактировать запись</a>
                    </div>
                    <div class="col">
                        <form action="{{ route('log.destroy',['id'=>$log->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Удалить запись">
                        </form>
                    </div>

                </div>
             </div>
        </div>
    </div>
    <div class="container text-white " style="justify-content: center;">
        <fieldset disabled>
            <div class="container text-left">
                <h4 style="padding-top: 16px">Полная информация</h4>
                <hr>

                <p id="date_receipt">Дата поступления:
                    <strong style="color: dodgerblue">{{ $log->logReceipt->first()->date_receipt }}</strong></p>
                <p id="string_time_receipt">Время поступления:
                    <strong style="color: dodgerblue">{{ $log->logReceipt->first()->time_receipt }}</strong></p>
                <hr>

                <p id="full_name">Фамилия, имя, отчество (при наличии):
                    <strong style="color: dodgerblue">{{ $log->patient->name }}</strong></p>
                <p id="birth_day">Дата рождения (число, месяц, год):
                    <strong style="color: dodgerblue">{{ $log->patient->birth_day }}</strong></p>
                <p id="gender">Пол (мужской, женский):
                    <strong style="color: dodgerblue">{{ $log->patient->gender }}</strong></p>
                <p id="medical_card">Номер медицинской карты:
                    <strong style="color: dodgerblue">{{ $log->patient->medical_card }}</strong></p>
                <p id="passport">Серия и номер паспорта или иного документа,
                    удостоверяющего личность (при наличии):
                    <strong style="color: dodgerblue">{{ $log->patient->passport }}</strong></p>
                <p id="nationality">Гражданство:
                    <strong style="color: dodgerblue">{{ $log->patient->nationality }}</strong></p>
                <p id="address">Регистрация по месту жительства:
                    <strong style="color: dodgerblue">{{ $log->patient->address }}</strong></p>
                <p id="registration_place_stay">Регистрация по месту пребывания пациента:
                    <strong style="color: dodgerblue">{{ $log->patient->register_place }}</strong></p>
                <p id="snils">СНИСЛ (при наличии):
                    <strong style="color: dodgerblue">{{ $log->patient->snils }}</strong></p>
                <p id="polis">Полис обязательного медицинского страхования (при наличии):
                    <strong style="color: dodgerblue">{{ $log->patient->polis }}</strong></p>
                <hr>
                <p id="number_phone_representative">Номер телефона законного представителя, лица, которому может
                    быть передана информация о состоянии здоровья пациента:
                    <strong style="color: dodgerblue">{{ $log->logReceipt->first()->phone_agent }}</strong></p>
                <p id="delivered">Пациент доставлен (направлен):
                    <strong style="color: dodgerblue">{{ $log->logReceipt->first()->delivered }}</strong></p>
                <p id="fact_alcohol">Факт употребления алкоголя и иных психоактивных веществ,
                    установление наличия или отсутствия признаков состояния опьянения при поступлении пациента
                    в медицинскую организацию:
                    <strong style="color: dodgerblue">{{ $log->logReceipt->first()->fact_alcohol }}</strong></p>
                <p id="date_time_alcohol">Дата и время взятия пробы:
                    <strong style="color: dodgerblue">{{ $log->logReceipt->first()->datetime_alcohol }}</strong></p>
                <p id="result_research">Результаты лабораторных исследований:
                    <strong style="color: dodgerblue">{{ $log->logReceipt->first()->result_research }}</strong></p>
                <p id="department_medical_organization">Отделение медицинской организации, в которое
                    направлен пациент:
                    <strong style="color: dodgerblue">{{ $log->logReceipt->first()->section_medical }}</strong></p>
                <hr>
                <p id="outcome_hospitalization">Исход госпитализации:
                    <strong style="color: dodgerblue">{{ $log->logDischarge->first()->outcome }}</strong></p>
                <p id="date_time_discharge">Дата и время исхода:
                    <strong style="color: dodgerblue">{{ $log->logDischarge->first()->datetime_discharge }}</strong></p>
                <p id="medical_organization_transferred">Наименование медицинской организации,
                    куда переведен пациент:
                    <strong style="color: dodgerblue">{{ $log->logDischarge->first()->section_transferred }}</strong></p>
                <p id="date_time_inform">Дата и время сообщения законному представителю, иному лицу
                    или медицинской организации, направившей пациента, о госпитализации (отказе в госпитализации) пациента,
                    ее исходе:
                    <strong style="color: dodgerblue">{{ $log->logDischarge->first()->datetime_inform }}</strong></p>
                <hr>
                <h4> В случае отказа в госпитализации в стационар, дневной стационар</h4>
                <p id="reason_refusal">Причина отказа в госпитализации:
                    <strong style="color: dodgerblue">{{ $log->logReject->first()->reason_refusal }}</strong></p>
                <p id="full_name_medical_worker">Фамилия, имя, отчество (при наличии) медицинского
                    работника, зафиксировавшего причину отказа в госпитализации:
                    <strong style="color: dodgerblue">{{ $log->logReject->first()->name_medical_worker }}</strong></p>
                <p id="additional_information">Дополнительные сведения:
                    <strong style="color: dodgerblue">{{ $log->logReject->first()->add_info }}</strong></p>
            </div>
        </fieldset>
    </div>

@endsection
