@extends('layouts.template')

@section('title')
    Добавление данных в журнал учета
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container text-white blurBG" style="justify-content: center; width: 50vw; border-radius: 7px">
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
                <input class="form-control mb-4" type="date" name="date_receipt" id="date_receipt" value="${date_now}" >

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
                <input class="form-control mb-4" type="time" name="time_receipt" id="time_receipt" maxlength="5" value="${time_now}">

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
                <input value="{{ old('birth_ady') }}" class="form-control mb-4" type="date" name="birth_day" id="birth_day" >

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
                    <option value="мужской">мужской</option>
                    <option value="женский">женский</option>
                </select>

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

                <label class="form-label" for="number_phone_representative">Номер телефона законного представителя, лица, которому может
                    быть передана информация о состоянии здоровья пациента</label>
                <input class="form-control mb-4" type="text" id="number_phone_representative" name="number_phone_representative" maxlength="18" placeholder="8 (XXX) XXX XX XX" autocomplete="off">

                <label class="form-label" for="snils">СНИСЛ (при наличии)</label>
                <input value="{{ old('snils') }}" class="form-control mb-4" type="text" id="snils" name="snils" maxlength="14" placeholder="XXX-XXX-XXX XX" autocomplete="off">

                <label class="form-label" for="polis">Полис обязательного медицинского страхования (при наличии)</label>
                <input value="{{ old('polis') }}" class="form-control mb-4" type="text" id="polis" name="polis" maxlength="16" autocomplete="off" placeholder="XXXXXXXXXXXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '')">

                <label class="form-label" for="delivered">Пациент доставлен (направлен)</label>
                <select class="form-select mb-4" name="delivered" id="delivered" size="1">
                    <option value="" style="font-weight: bold">Пожалуйста, сделайте выбор</option>
                    <option value="полицией">полицией</option>
                    <option value="бригадой скорой медицинской помощи">бригадой скорой медицинской помощи</option>
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
                <input value="{{ old('midical_card') }}" class="form-control mb-4" type="text" name="medical_card" id="medical_card">

                <input type="submit" value="Добавить запись" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
