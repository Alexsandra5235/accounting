@extends('layouts.template')

@section('title')
    Панель администратора
@endsection

@section('content')
    <div class="row m-0">
        <div class="col-auto">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
                <nav class="mb-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link active text-white" id="nav-user-tab" data-bs-toggle="tab" data-bs-target="#nav-user" type="button" role="tab" aria-controls="nav-user" aria-selected="true">
                                    Все пользователи
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white" id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register" aria-selected="false">
                                    Добавление пользователя
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-history" aria-selected="false">
                                    История взаимодействия
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="col m-3">
            <div class="tab-content flex-column d-flex" id="nav-tabContent">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif
                <div class="tab-pane fade show active" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab" tabindex="0">
                    <div class="tab-content pt-3">
                        <div class="tab-pane active">
                            @if($users->isEmpty())
                                <h2 class="text-center">Данных нет</h2>
                            @else
                                <h1>Все пользователи системы</h1>
                                <div class="container">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                                        @foreach($users as $user)
                                            <div class="card mb-4 me-4">
                                                <div class="card-body text-center">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                                         class="rounded-circle img-fluid" style="width: 150px;">
                                                    {{--                                                <svg id="svg" fill="#000000" stroke="#000000" width="200px" height="200px" version="1.1" viewBox="144 144 512 512" xmlns="http://www.w3.org/2000/svg">--}}
                                                    {{--                                                    <g id="IconSvg_bgCarrier" stroke-width="0"></g>--}}
                                                    {{--                                                    <g id="IconSvg_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC"></g>--}}
                                                    {{--                                                    <g id="IconSvg_iconCarrier">--}}
                                                    {{--                                                        <g xmlns="http://www.w3.org/2000/svg">--}}
                                                    {{--                                                            <path d="m400 604.67c-54.285 0-106.34-21.562-144.73-59.949-38.383-38.383-59.949-90.441-59.949-144.72 0-54.285 21.566-106.34 59.949-144.73 38.383-38.383 90.441-59.949 144.73-59.949 54.281 0 106.34 21.566 144.72 59.949 38.387 38.383 59.949 90.441 59.949 144.73 0 54.281-21.562 106.34-59.949 144.72-38.383 38.387-90.441 59.949-144.72 59.949zm0-377.86c-45.934 0-89.984 18.246-122.46 50.727-32.48 32.477-50.727 76.527-50.727 122.46 0 45.93 18.246 89.98 50.727 122.46 32.477 32.48 76.527 50.727 122.46 50.727 45.93 0 89.98-18.246 122.46-50.727 32.48-32.477 50.727-76.527 50.727-122.46 0-45.934-18.246-89.984-50.727-122.46-32.477-32.48-76.527-50.727-122.46-50.727z"/>--}}
                                                    {{--                                                            <path d="m400 195.32c-54.285 0-106.34 21.566-144.73 59.949-38.383 38.383-59.949 90.441-59.949 144.73 0 54.281 21.566 106.34 59.949 144.72 38.383 38.387 90.441 59.949 144.73 59.949 54.281 0 106.34-21.562 144.72-59.949 38.387-38.383 59.949-90.441 59.949-144.72 0-54.285-21.562-106.34-59.949-144.73-38.383-38.383-90.441-59.949-144.72-59.949zm0 94.465c16.699 0 32.719 6.6367 44.531 18.445 11.809 11.812 18.445 27.828 18.445 44.531s-6.6367 32.723-18.445 44.531c-11.812 11.812-27.832 18.445-44.531 18.445-16.703 0-32.723-6.6328-44.531-18.445-11.812-11.809-18.445-27.828-18.445-44.531s6.6328-32.719 18.445-44.531c11.809-11.809 27.828-18.445 44.531-18.445zm0 283.39c-22.832-0.011719-45.438-4.5391-66.512-13.324-21.078-8.7812-40.207-21.641-56.293-37.844 12.594-43.297 62.977-74.785 122.8-74.785s110.21 31.488 122.8 74.785h-0.003907c-16.086 16.203-35.215 29.062-56.293 37.844-21.074 8.7852-43.676 13.312-66.508 13.324z"/>--}}
                                                    {{--                                                        </g>--}}

                                                    {{--                                                    </g>--}}
                                                    {{--                                                </svg>--}}
                                                    <h5 class="my-3">{{$user->name}}</h5>
                                                    <p class="text-muted mb-1">{{$user->email}}</p>
                                                    <p class="text-muted mb-1">Роль: {{$user->getRoleNames()->first()}}</p>
                                                    <p class="text-muted mb-4">{{$user->created_at}}</p>
                                                    <div class="d-flex justify-content-center mb-2">
                                                        <form action="{{ route('user.delete',['id'=>$user->id]) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-primary btn-sm">Удалить профиль</button>
                                                        </form>
                                                        <a href="#" type="button" class="btn btn-outline-primary btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{$user->id}}">
                                                            <span>Редактировать</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Вертикально центрированное модальное окно -->
                                            <div class="modal fade" id="exampleModalEdit{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalEditTitle" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalEditTitle">Редактирование данных профиля</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('user.edit',['id'=>$user->id]) }}" class="m-2">
                                                            @csrf
                                                            @method('put')

                                                            <div class="row mb-3">
                                                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Имя') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                                                    @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Почта') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                                                    @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Роль') }}</label>

                                                                <div class="col-md-6">
                                                                    <select class="form-select" name="role" id="role">
                                                                        <option {{ $user->getRoleNames()->first() == 'user' ? 'selected' : '' }} value="user">user</option>
                                                                        <option {{ $user->getRoleNames()->first() == 'admin' ? 'selected' : '' }} value="admin">admin</option>
                                                                    </select>

                                                                    @error('role')
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row mb-0">
                                                                <div class="col-md-6 offset-md-4">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Изменить') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab" tabindex="0">
                    <div class="tab-content pt-3">
                        <h1>Добавление нового пользователя</h1>
                        <div class="tab-pane active">
                            <div class="card">
                                <div class="card-header">{{ __('Регистрация') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('user.store') }}">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Имя') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Почта') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Повторите пароль') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Регистрация') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab" tabindex="0">
                    <div class="tab-content pt-3">
                        <h1 class="text-center">История взаимодействия с системой</h1>
                        <div class="tab-pane active">
                            <div class="container">
                                <div id="content">
                                    <ul class="timeline">
                                        @if($histories->isEmpty())
                                            <h2 class="text-center">Данных нет</h2>
                                        @else
                                            @foreach($histories as $history)
                                                @if($history->user)
                                                    <div class="col d-flex justify-content-end">
                                                        <a href="#"> {{ $history->user->name }} </a>
                                                    </div>
                                                @else
                                                    <p class="text-end">Пользователь удален </p>
                                                @endif
                                                @php
                                                    $changes = explode(';', $history->diff);
                                                    $listItems = '';

                                                    foreach ($changes as $change) {
                                                        $change = trim($change);
                                                        if (!empty($change)) {
                                                            $listItems .= "<li>{$change}</li>";
                                                        }
                                                    }

                                                    $tooltipContent = "<ul class='custom-tooltip'>{$listItems}</ul>";
                                                @endphp

                                                <li class="event me-4" data-date="{{ \Carbon\Carbon::parse($history->created_at)->format('d.m.Y H:i') }}">
                                                    <h3>
                                                        {{ $history->header }}
                                                        @if(Str::contains("$history->header", 'Редактирование'))
                                                            <a href="#" style="text-decoration: none"
                                                               data-bs-toggle="tooltip" data-bs-placement="right"
                                                               data-bs-custom-class="custom-tooltip" data-bs-html="true"
                                                               data-bs-title="<h6>Внесенные изменения</h6>{{ $tooltipContent  }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" style="color: dodgerblue" class="bi bi-asterisk" viewBox="0 0 16 16">
                                                                    <path d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1"/>
                                                                </svg>
                                                            </a>
                                                        @endif
                                                    </h3>
                                                    @if($history->log)
                                                        <p>Имя пациента: {{ $history->log->patient->name }}</p>
                                                        <p>Номер медицинской карты: {{ $history->log->patient->medical_card }}</p>
                                                        <p>Дата и время поступления: {{ $history->log->receipt->date_receipt }} {{ $history->log->receipt->time_receipt }}</p>
                                                        <a href="{{ route('log.show',['id'=>$history->log_id]) }}">Нажмите, если хотите перейти к записи</a>
                                                    @else
                                                        <p>{{ $history->description }}</p>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
