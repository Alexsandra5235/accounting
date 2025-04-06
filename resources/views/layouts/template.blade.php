<!doctype html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        #suggestions_state, #suggestions_wound, #suggestions_address,
        #suggestions_register{
            max-height: 150px;
            overflow-y: auto;
        }
        .emp-profile{
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 70%;
            height: 100%;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }
        .profile-head h5{
            color: #333;
        }
        .profile-head h6{
            color: #0062cc;
        }
        .profile-edit-btn{
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }
        .proile-rating{
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }
        .proile-rating span{
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }
        .profile-head .nav-tabs{
            margin-bottom:5%;
        }
        .profile-head .nav-tabs .nav-link{
            font-weight:600;
            border: none;
        }
        .profile-head .nav-tabs .nav-link.active{
            border: none;
            border-bottom:2px solid #0062cc;
        }
        .profile-work{
            padding: 14%;
            margin-top: -15%;
        }
        .profile-work p{
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }
        .profile-work a{
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }
        .profile-work ul{
            list-style: none;
        }
        .profile-tab label{
            font-weight: 600;
        }
        .profile-tab p{
            font-weight: 600;
            color: #0062cc;
        }
    </style>
</head>
<body>
<div class="container py-2">
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <a href="{{ route('home') }}" class="d-flex align-items-center link-body-emphasis text-decoration-none">
            JOURNAL
        </a>

        @guest
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                @if (Route::has('login'))
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none top-50" href="{{ route('login') }}">{{ __('Вход') }}</a>
                @endif

                @if (Route::has('register'))
                        <a class="me-3 py-2 link-body-emphasis text-decoration-none top-50" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                @endif
            </nav>
        @else

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                @if(Route::currentRouteName() == 'home' || Route::currentRouteName() == 'log.search')
                    <form action="{{ route('log.search') }}" method="get" autocomplete="off" class="d-flex me-5">
                        @csrf
                        <div class="input-group me-2">
                            <input class="form-control pe-xxl-5 text-left" name="name" id="name" type="text" placeholder="Поиск пациента по ФИО">
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                </svg>
                            </a>
                            <button class="btn btn-primary" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                @endif
                <a class="me-4 py-2 link-body-emphasis text-decoration-none top-50" href="{{ route('log.add') }}">Добавить пациента</a>
                <a class="me-4 py-2 link-body-emphasis text-decoration-none" href="/register">Справочная информация</a>
                <div class="dropdown py-2 me-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Формирование отчетов
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="/profile/{{ Auth::id() }}">Лист ежедневного учета</a></li>
                        <li><a class="dropdown-item" href="/logout">Сводная ведомость</a></li>
                    </ul>
                </div>
                <div class="dropdown py-2 me-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::user()->avatar )
                            <img src="{{ asset('storage/' . Auth::user()->avatar->avatar_path) }}" alt="avatar"
                                 class="rounded-circle img-fluid me-2" width="32px" height="32px">
                        @endif
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Мой профиль</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </nav>
        @endguest
    </div>
</div>

@yield('content')

<div class="container py-2">
    <footer class="pt-3 mt-4 text-body-secondary border-top">© 2025</footer>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script>
    function setupSuggestions(inputSelector, suggestionsContainerSelector, valueSelector) {
        $(inputSelector).on('input', function() {
            let query = $(this).val();
            $(suggestionsContainerSelector).empty().hide();
            if (query.length >= 2) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('api.diagnosis') }}',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        query: query,
                    }),
                    success: function(data) {
                        $(suggestionsContainerSelector).empty().hide();
                        if (data.suggestions.length > 0) {
                            data.suggestions.forEach(function(item) {
                                const code = item.data.code || "Неизвестный код";
                                const value = item.value || "Неизвестное значение";

                                let suggestionItem = $('<button class="dropdown-item suggestion-item"></button>');
                                suggestionItem.text(`${code} - ${value}`);
                                suggestionItem.on('click', function() {
                                    $(inputSelector).val(code);
                                    $(valueSelector).val(value);
                                    $(suggestionsContainerSelector).empty().hide();
                                });
                                $(suggestionsContainerSelector).append(suggestionItem);
                            });
                            $(suggestionsContainerSelector).show();
                        }
                    },
                    error: function(err) {
                        console.error('Ошибка при обращении к контроллеру:', err);
                    }
                });
            }
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest(inputSelector).length) {
                $(suggestionsContainerSelector).empty().hide();
            }
        });
    }

    function setupCountry(inputSelector, suggestionsContainerSelector) {
        $(inputSelector).on('input', function() {
            let query = $(this).val();
            $(suggestionsContainerSelector).empty().hide();
            if (query.length >= 2) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('api.country') }}',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        query: query,
                    }),
                    success: function(data) {
                        $(suggestionsContainerSelector).empty().hide();
                        if (data.suggestions.length > 0) {
                            $(suggestionsContainerSelector).show();
                            data.suggestions.forEach(function(item) {
                                const value = item.value || "Неизвестное значение";

                                let suggestionItem = $('<button class="dropdown-item suggestion-item"></button>');
                                suggestionItem.text(`${value}`);
                                suggestionItem.on('click', function() {
                                    $(inputSelector).val(value);
                                    $(suggestionsContainerSelector).empty().hide();
                                });
                                $(suggestionsContainerSelector).append(suggestionItem);
                            });
                        }
                    },
                    error: function(err) {
                        console.error('Ошибка при обращении к контроллеру:', err);
                    }
                });
            }
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest(inputSelector).length) {
                $(suggestionsContainerSelector).empty().hide();
            }
        });
    }

    function setupAddress(inputSelector, suggestionsContainerSelector) {
        $(inputSelector).on('input', function() {
            let query = $(this).val();
            $(suggestionsContainerSelector).empty().hide();

            if (query.length >= 2) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('api.address') }}', // Laravel route
                    type: 'post',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        query: query,
                    }),
                    success: function(data) {
                        console.log(data);
                        if (data.suggestions && data.suggestions.length > 0) {
                            $(suggestionsContainerSelector).show();
                            data.suggestions.forEach(function(item) {
                                const value = item.value || "Неизвестное значение";

                                let suggestionItem = $('<button class="dropdown-item suggestion-item"></button>');
                                suggestionItem.text(value);
                                suggestionItem.on('click', function() {
                                    $(inputSelector).val(value);
                                    $(suggestionsContainerSelector).empty().hide();
                                });
                                $(suggestionsContainerSelector).append(suggestionItem);
                            });
                        }
                    },
                    error: function(err) {
                        console.error('Ошибка при обращении к контроллеру:', err);
                    }
                });
            }
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest(inputSelector).length) {
                $(suggestionsContainerSelector).empty().hide();
            }
        });
    }

    setupSuggestions('#state_code', '#suggestions_state', '#state_value');

    setupSuggestions('#wound_code', '#suggestions_wound', '#wound_value');

    setupCountry('#nationality', '#suggestions_country');

    setupAddress('#address','#suggestions_address');

    setupAddress('#register_place','#suggestions_register');


</script>
</body>
</html>
