@extends('layouts.template')

@section('title')
    Добавление данных в журнал учета
@endsection

@section('content')
    <div class="container">
        <div class="container text-white blurBG" style="justify-content: center; width: 50vw; border-radius: 7px">
            @if ($errors->has('save_error'))
                <div class="card">
                    <div class="card_body">
                        <div class="card-header">
                            Ошибка данных
                        </div>
                        {{ $errors->first('save_error') }}
                    </div>
                </div>
            @elseif($errors->any())
                <div class="card">
                    <div class="card_body">
                        <div class="card-header">
                            Ошибка данных
                        </div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <h4 style="padding-top: 16px">Добавление записи</h4>
            <hr>
            <form action="{{ route('log.store') }}" method="post" autocomplete="off" id="formAddJournal" style="padding: 10px; margin-bottom: 20px">
                @csrf
                <label class="form-label" for="date_receipt">Дата поступления
                    <a href="#" style="text-decoration: none"
                       data-bs-toggle="tooltip" data-bs-placement="top"
                       data-bs-custom-class="custom-tooltip"
                       data-bs-title="Это поле обязательно для заполнения">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" style="color: dodgerblue" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                        </svg>
                    </a>
                </label><br>
                <input class="form-control mb-4" type="date" name="date_receipt" id="date_receipt"
                       value="{{ date('Y-m-d') }}">

                <label class="form-label" for="time_receipt">Время поступления
                    <a href="#" style="text-decoration: none"
                       data-bs-toggle="tooltip" data-bs-placement="top"
                       data-bs-custom-class="custom-tooltip"
                       data-bs-title="Это поле обязательно для заполнения">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" style="color: dodgerblue" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                        </svg>
                    </a>
                </label><br>
                <input class="form-control mb-4" type="time" name="time_receipt" id="time_receipt" maxlength="5"
                       value="{{ date("H:i", strtotime('+7 hours')) }}">

                <label class="form-label" for="name">Фамилия, имя, отчество (при наличии)
                    <a href="#" style="text-decoration: none"
                       data-bs-toggle="tooltip" data-bs-placement="top"
                       data-bs-custom-class="custom-tooltip"
                       data-bs-title="Это поле обязательно для заполнения">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" style="color: dodgerblue" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                        </svg>
                    </a>
                </label><br>
                <input value="{{ old('name') }}" class="form-control mb-4" type="text" name="name" id="name" placeholder="Иванов Иван Иванович" autocomplete="off">

                <label class="form-label" for="birth_day">Дата рождения (число, месяц, год):
                    <a href="#" style="text-decoration: none"
                       data-bs-toggle="tooltip" data-bs-placement="top"
                       data-bs-custom-class="custom-tooltip"
                       data-bs-title="Это поле обязательно для заполнения">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" style="color: dodgerblue" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                        </svg>
                    </a>
                </label><br>
                <input value="{{ old('birth_day') }}" class="form-control mb-4" type="date" name="birth_day" id="birth_day" >

                <label class="form-label" for="gender">Пол (мужской, женский)
                    <a href="#" style="text-decoration: none"
                       data-bs-toggle="tooltip" data-bs-placement="top"
                       data-bs-custom-class="custom-tooltip"
                       data-bs-title="Это поле обязательно для заполнения">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" style="color: dodgerblue" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                        </svg>
                    </a>
                </label><br>
                <select class="form-select mb-4" name="gender" id="gender" size="1" >
                    <option value="" style="font-weight: bold">Пожалуйста, сделайте выбор</option>
                    <option value="мужской" {{ old('gender') == 'мужской' ? 'selected' : '' }}>мужской</option>
                    <option value="женский" {{ old('gender') == 'женский' ? 'selected' : '' }}>женский</option>
                </select>

                <label class="form-label" for="medical_card">Номер медицинской карты
                    <a href="#" style="text-decoration: none"
                       data-bs-toggle="tooltip" data-bs-placement="top"
                       data-bs-custom-class="custom-tooltip"
                       data-bs-title="Это поле обязательно для заполнения">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" style="color: dodgerblue" class="bi bi-asterisk" viewBox="0 0 16 16">
                            <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                        </svg>
                    </a>
                </label><br>
                <input value="{{ old('medical_card') }}" class="form-control mb-4" type="text" name="medical_card" id="medical_card">

                <label class="form-label" for="passport">Серия и номер паспорта или иного документа, удостоверяющего личность (при наличии)</label><br>
                <input value="{{ old('passport') }}" class="form-control mb-4" type="text" name="passport" id="passport" maxlength="12" placeholder="XX XX XXXXXX">

                <label class="form-label" for="nationality">Гражданство</label><br>
                <input value="{{ old('nationality') }}" class="form-control mb-4" type="text" id="nationality" name="nationality">
                <div id="suggestions_country"></div>

                <label class="form-label" for="address">Регистрация по месту жительства</label><br>
                <input value="{{ old('address') }}" class="form-control mb-4" type="text" id="address" name="address" autocomplete="off" size="100">
                <div id="suggestions"></div>

                <label class="form-label" for="register_place">Регистрация по месту пребывания пациента</label><br>
                <input value="{{ old('register_place') }}" type="text" class="form-control" name="register_place" id="register_place">
                <div id="suggestions-stay" style="margin-top: 0"></div>
                <label class="mb-4">
                    <input type="checkbox" class="custom-checkbox" value="Совпадает с местом регистрации">
                    Совпадает с местом регистрации
                </label>

                <label class="form-label" for="phone_agent">Номер телефона законного представителя, лица, которому может
                    быть передана информация о состоянии здоровья пациента</label>
                <input value="{{ old('phone_agent') }}" class="form-control mb-4" type="text" id="phone_agent" name="phone_agent" maxlength="18" placeholder="8 (XXX) XXX XX XX" autocomplete="off">

                <label class="form-label" for="snils">СНИСЛ (при наличии)</label>
                <input value="{{ old('snils') }}" class="form-control mb-4" type="text" id="snils" name="snils" maxlength="14" placeholder="XXX-XXX-XXX XX" autocomplete="off">

                <label class="form-label" for="polis">Полис обязательного медицинского страхования (при наличии)</label>
                <input value="{{ old('polis') }}" class="form-control mb-4" type="text" id="polis" name="polis" maxlength="16" autocomplete="off" placeholder="XXXXXXXXXXXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '')">

                <label class="form-label" for="delivered">Пациент доставлен (направлен)</label>
                <select class="form-select mb-4" name="delivered" id="delivered" size="1">
                    <option value="" style="font-weight: bold">Пожалуйста, сделайте выбор</option>
                    <option value="полицией" {{ old('delivered' == 'полицией' ? 'selected' : '') }}>полицией</option>
                    <option value="выездной бригадой скорой медицинской помощи" {{ old('delivered' == 'выездной бригадой скорой медицинской помощи' ? 'selected' : '') }}>бригадой скорой медицинской помощи </option>
                    <option value="другой медицинской организацией" {{ old('delivered' == 'другой медицинской организацией' ? 'selected' : '') }}>полицией</option>
                    <option value="обратился самостоятельно" {{ old('delivered' == 'обратился самостоятельно' ? 'selected' : '') }}>полицией</option>
                </select>

                <label class="form-label" for="fact_alcohol">Факт употребления алкоголя и иных психоактивных веществ,
                    установление наличия или отсутствия признаков состояния опьянения при поступлении пациента
                    в медицинскую организацию</label>
                <input value="{{ old('fact_alcohol') }}" class="form-control mb-4" type="text" id="fact_alcohol" name="fact_alcohol" autocomplete="off">

                <label class="form-label" for="datetime_alcohol">Дата и время взятия пробы</label>
                <input value="{{ old('datetime_alcohol') }}" class="form-control mb-4" type="datetime-local" id="datetime_alcohol" name="datetime_alcohol">

                <label class="form-label" for="result_research">Результаты лабораторных исследований</label>
                <input value="{{ old('result_research') }}" class="form-control mb-4" type="text" id="result_research" name="result_research">

                <label class="form-label" for="section_medical">Отделение медицинской организации, в которое направлен пациент</label>
                <input value="{{ old('section_medical') }}" class="form-control mb-4" type="text" id="section_medical" name="section_medical" autocomplete="off">

                <label class="form-label" for="outcome">Исход госпитализации</label>
                <select class="form-select mb-4" name="outcome" id="outcome" size="1">
                    <option value="" style="font-weight: bold">Пожалуйста, сделайте выбор</option>
                    <option value="выписан" {{ old('outcome' == 'выписан' ? 'selected' : '') }}>умер</option>
                    <option value="переведен в другую медицинскую организацию" {{ old('outcome' == 'переведен в другую медицинскую организацию' ? 'selected' : '') }}>умер</option>
                    <option value="умер" {{ old('outcome' == 'умер' ? 'selected' : '') }}>умер</option>

                </select>

                <label class="form-label" for="datetime_discharge">Дата и время исхода</label>
                <input value="{{ old('datetime_discharge') }}" class="form-control mb-4" type="datetime-local" id="datetime_discharge" name="datetime_discharge" autocomplete="off">

                <div id="medicalOrgField">
                    <label class="form-label" for="section_transferred">Наименование медицинской организации, куда переведен пациент</label>
                    <input value="{{ old('section_transferred') }}" class="form-control mb-4" type="text" id="section_transferred" name="section_transferred" autocomplete="off">
                </div>

                <label class="form-label" for="datetime_inform"> Дата и время сообщения законному представителю, иному лицу<br>
                    или медицинской организации, направившей пациента, о госпитализации (отказе в госпитализации) пациента, ее исходе</label>
                <input value="{{ old('datetime_inform') }}" class="form-control mb-4" type="datetime-local" id="datetime_inform" name="datetime_inform" autocomplete="off">

                <h4> В случае отказа в госпитализации в стационар, дневной стационар</h4>

                <label class="form-label" for="reason_refusal">Причина отказа в госпитализации</label>
                <select class="form-select mb-4" name="reason_refusal" id="reason_refusal" size="1">
                    <option value="" selected style="font-weight: bold"> Пожалуйста, сделайте выбор...</option>
                    <option value="отказался пациент" {{ old('reason_refusal' == 'отказался пациент' ? 'selected' : '') }}>устал</option>
                    <option value="отсутствие показаний" {{ old('reason_refusal' == 'отсутствие показаний' ? 'selected' : '') }}>устал</option>
                    <option value="помощь оказана в приемном отделении медицинской организации" {{ old('reason_refusal' == 'помощь оказана в приемном отделении медицинской организации' ? 'selected' : '') }}>устал</option>
                    <option value="направлен в другую медицинскую организацию" {{ old('reason_refusal' == 'направлен в другую медицинскую организацию' ? 'selected' : '') }}>устал</option>
                    <option value="иная причина" {{ old('reason_refusal' == 'иная причина' ? 'selected' : '') }}>устал</option>
                </select>

                <label class="form-label" for="name_medical_worker">Фамилия, имя, отчество (при наличии) медицинского работника,
                    зафиксировавшего причину отказа в госпитализации</label>
                <input value="{{ old('name_medical_worker') }}" class="form-control mb-4" type="text" id="name_medical_worker" name="name_medical_worker" autocomplete="off" placeholder="Иванов Иван Иванович">

                <label class="form-label" for="add_info">Дополнительные сведения</label>
                <input value="{{ old('add_info') }}" class="form-control mb-4" type="text" id="add_info" name="add_info" autocomplete="off">

                <input type="submit" value="Добавить запись" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
