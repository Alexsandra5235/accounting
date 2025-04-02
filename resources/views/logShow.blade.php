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
                        <li class="breadcrumb-item"><a href="/" style="padding-right: 14px">Главная</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page" style="padding-left: 0">Просмотр записи пациента</li>
                    </ol>
                </nav>
                <h5 class="card-title mb-2">Полная информация по пациенту<span class="h5" style="color: dodgerblue"> </span></h5>
                <p class="card-text mb-1">Дата и время создания записи:</p>

                <p class="card-text mb-1" style="margin-bottom: 8px">Дата и время последнего редактирования записи</p>
                <a class="btn btn-primary" href="/patient">Просмотр плана лечения</a>
             </div>
        </div>
    </div>

    <div class="container text-white " style="justify-content: center; width: 50vw; border-radius: 7px; margin-bottom: 20px">
        <fieldset disabled>
            <div class="container text-left">
                <h4 style="padding-top: 16px">Полная информация</h4>
                <hr>

                <label class="form-label" for="date_receipt">Дата поступления:</label>
                <p id="date_receipt"></p>
                <hr>

                <label class="form-label" for="string_time_receipt">Время поступления:</label>
                <p id="string_time_receipt"></p>
                <hr>

                <label class="form-label" for="full_name">Фамилия, имя, отчество (при наличии):</label>
                <p id="full_name">{{ $log->name }}</p>
                <hr>

                <label class="form-label" for="birth_day">Дата рождения (число, месяц, год):</label>
                <p id="birth_day">{{ $log->birth_day }}</p>
                <hr>

                <label class="form-label" for="gender">Пол (мужской, женский):</label>
                <p id="gender">{{ $log->gender }}</p>
                <hr>

                <label class="form-label" for="passport">Серия и номер паспорта или иного документа,
                    удостоверяющего личность (при наличии)</label><br>
                <p id="passport">{{ $log->passport }}</p>
                <hr>

                <label class="form-label" for="nationality">Гражданство</label><br>
                <p id="nationality">{{ $log->nationality }}</p>
                <hr>

                <label class="form-label" for="address">Регистрация по месту жительства</label><br>
                <p id="address">{{ $log->address }}</p>
                <hr>

                <label class="form-label" for="registration_place_stay">Регистрация по месту пребывания пациента</label><br>
                <p id="registration_place_stay">{{ $log->register_place }}</p>
                <hr>

                <label class="form-label" for="number_phone_representative">Номер телефона законного представителя, лица, которому может
                    быть передана информация о состоянии здоровья пациента</label>
                <p id="number_phone_representative"></p>
                <hr>

                <label class="form-label" for="snils">СНИСЛ (при наличии)</label>
                <p id="snils">{{ $log->snils }}</p>
                <hr>

                <label class="form-label" for="polis">Полис обязательного медицинского страхования (при наличии)</label>
                <p id="polis">{{ $log->polis }}</p>
                <hr>

                <label class="form-label" for="delivered">Пациент доставлен (направлен)</label>
                <p id="delivered"></p>
                <hr>

                <label class="form-label" for="medical_card">Номер медицинской карты</label>
                <p id="medical_card">{{ $log->medical_card }}</p>
                <hr>

                <label class="form-label" for="medical">Диагноз заболевания (состояния), поставленный направившей медицинской
                    организацией, выездной бригадой скорой медицинской помощи (код по МКБ)</label>
                <p id="medical"></p>
                <hr>

                <label class="form-label" for="cause_injury">Причина и обстоятельства травмы (в том числе при
                    дорожно-транспортных проишествиях) отравления (код по МКБ)</label>
                <p id="cause_injury"></p>
                <hr>

                <label class="form-label" for="fact_alcohol">Факт употребления алкоголя и иных психоактивных веществ,
                    установление наличия или отсутствия признаков состояния опьянения при поступлении пациента
                    в медицинскую организацию</label>
                <p id="fact_alcohol"></p>
                <hr>

                <label class="form-label" for="date_time_alcohol">Дата и время взятия пробы</label>
                <p id="date_time_alcohol"></p>
                <hr>

                <label class="form-label" for="result_research">Результаты лабораторных исследований</label>
                <p id="result_research"></p>
                <hr>

                <label class="form-label" for="department_medical_organization">Отделение медицинской организации, в которое
                    направлен пациент</label>
                <p id="department_medical_organization"></p>
                <hr>

                <label class="form-label" for="outcome_hospitalization">Исход госпитализации</label>
                <p id="outcome_hospitalization"></p>
                <hr>

                <label class="form-label" for="date_time_discharge">Дата и время исхода</label>
                <p id="date_time_discharge"></p>
                <hr>


                <label class="form-label" for="medical_organization_transferred">Наименование медицинской организации,
                    куда переведен пациент</label>
                <p id="medical_organization_transferred">}</p>
                <hr>


                <label class="form-label" for="date_time_inform"> Дата и время сообщения законному представителю, иному лицу
                    или медицинской организации, направившей пациента, о госпитализации (отказе в госпитализации) пациента,
                    ее исходе</label>
                <p id="date_time_inform"></p>
                <hr>

                <h4> В случае отказа в госпитализации в стационар, дневной стационар</h4>

                <label class="form-label" for="reason_refusal">Причина отказа в госпитализации</label>
                <p id="reason_refusal"></p>
                <hr>

                <label class="form-label" for="full_name_medical_worker">Фамилия, имя, отчество (при наличии) медицинского
                    работника, зафиксировавшего причину отказа в госпитализации</label>
                <p id="full_name_medical_worker"></p>
                <hr>

                <label class="form-label" for="additional_information">Дополнительные сведения</label>
                <p id="additional_information"></p>
                <hr>
            </div>
        </fieldset>
    </div>

@endsection
