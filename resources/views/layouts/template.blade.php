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

    </style>

</head>
<body>
<div class="container py-2">
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
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
                <a class="me-4 py-2 link-body-emphasis text-decoration-none top-50" href="/sign">Добавить пациента</a>
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
                        <li><a class="dropdown-item" href="/profile/{{ Auth::id() }}">Мой профиль</a></li>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


</script>
</body>
</html>
