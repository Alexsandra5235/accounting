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
        /*Для истории взаимодействия*/
        .timeline {
            border-left: 3px solid #727cf5;
            border-bottom-right-radius: 4px;
            border-top-right-radius: 4px;
            background: rgba(114, 124, 245, 0.09);
            margin: 0 auto;
            letter-spacing: 0.2px;
            position: relative;
            line-height: 1.4em;
            font-size: 1.03em;
            padding: 50px;
            list-style: none;
            text-align: left;
            max-width: 60%;
        }

        @media (max-width: 767px) {
            .timeline {
                max-width: 98%;
                padding: 25px;
            }
        }

        .timeline h1 {
            font-weight: 300;
            font-size: 1.4em;
        }

        .timeline h2,
        .timeline h3 {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .timeline .event {
            border-bottom: 1px dashed #e8ebf1;
            padding-bottom: 25px;
            margin-bottom: 25px;
            position: relative;
        }

        @media (max-width: 767px) {
            .timeline .event {
                padding-top: 30px;
            }
        }

        .timeline .event:last-of-type {
            padding-bottom: 0;
            margin-bottom: 0;
            border: none;
        }

        .timeline .event:before,
        .timeline .event:after {
            position: absolute;
            display: block;
            top: 0;
        }

        .timeline .event:before {
            left: -207px;
            content: attr(data-date);
            text-align: right;
            font-weight: 100;
            font-size: 0.9em;
            min-width: 120px;
        }

        @media (max-width: 767px) {
            .timeline .event:before {
                left: 0px;
                text-align: left;
            }
        }

        .timeline .event:after {
            -webkit-box-shadow: 0 0 0 3px #727cf5;
            box-shadow: 0 0 0 3px #727cf5;
            left: -55.8px;
            background: #fff;
            border-radius: 50%;
            height: 9px;
            width: 9px;
            content: "";
            top: 5px;
        }

        @media (max-width: 767px) {
            .timeline .event:after {
                left: -31.8px;
            }
        }

        .rtl .timeline {
            border-left: 0;
            text-align: right;
            border-radius: 4px 0 0 4px;
            border-right: 3px solid #727cf5;
        }

        .rtl .timeline .event::before {
            left: 0;
            right: -170px;
        }

        .rtl .timeline .event::after {
            left: 0;
            right: -55.8px;
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
                        @if(Auth::user()->hasRole('admin'))
                            <li><a class="dropdown-item" href="{{ route('admin') }}">Панель администратора</a></li>
                        @endif
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

<script>
    $(function() {

        // инициализации подсказок для всех элементов на странице, имеющих атрибут data-toggle="tooltip"
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
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
