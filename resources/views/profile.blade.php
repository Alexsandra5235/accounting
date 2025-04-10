@extends('layouts.template')

@section('title')
    Мой профиль
@endsection

@section('content')
    <div class="container">
        <div class="row flex-lg-nowrap">
            <div class="col">
                <div class="row">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="e-profile">
                                    <div class="row mb-5">
                                        <div class="col-12 col-sm-auto">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                                 class="rounded-circle img-fluid" style="width: 150px;">
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name }}</h4>
                                                <div class="mt-2">
                                                    <div class="bd-example input-group mt-2" style="width: 100%">
                                                        <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                                                            <i class="fa fa-fw fa-camera"></i>
                                                            <span>Изменить фотографию</span>
                                                        </a>
                                                    </div>

                                                    <!-- Вертикально центрированное модальное окно -->
                                                    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Обновление фотографии профиля</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                                                </div>
                                                                <form action="/profile/{{$user->id}}/edit/avatar" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="modal-body">
                                                                        <div data-mdb-input-init class="form-outline mb-4">
                                                                            <label for="images" class="form-label">Выберите фотографии профиля:</label>
                                                                            <input class="form-control" type="file" name="images" id="images" multiple />
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                                        <input type="submit" class="btn btn-primary" value="Сохранить изменения">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center text-sm-right">
                                                <div class="text-muted"><small>Зарегистрировался {{$user->created_at}}</small></div>
                                            </div>
                                        </div>
                                    </div>
                                    <nav class="mb-3">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Настройки</button>
                                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-password" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Изменение пароля</button>
                                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">История</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                            <div class="tab-content pt-3">
                                                <div class="tab-pane active">
                                                    <form action="{{ route('profile.edit', ['id'=>$user->id]) }}" method="post">

                                                        @method('put')
                                                        @csrf

                                                        <div class="form-group mb-2">
                                                            <label for="name" class="form-label">Ваше имя</label>
                                                            <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                                                            @if ($errors->has('name'))
                                                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="email" class="form-label">Ваша почта</label>
                                                            <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}">
                                                            @if ($errors->has('email'))
                                                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                            <div class="col d-flex justify-content-end mb-3">
                                                                <button class="btn btn-primary" type="submit">Сохранить изменения</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('profile.edit.password', ['id'=>$user->id]) }}" method="post">
                                                            @csrf
                                                            @method('put')
                                                            <div class="form-group">
                                                                <label class="form-label" for="current_passwd">Текущий пароль</label>
                                                                <input class="form-control" type="password" name="current_passwd" id="current_passwd">
                                                                @if ($errors->has('current_passwd'))
                                                                    <div class="text-danger">{{ $errors->first('current_passwd') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password" class="form-label">Новый пароль</label>
                                                                <input class="form-control" type="password" name="password" id="password">
                                                                @if ($errors->has('password'))
                                                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group my-3">
                                                                <label for="password_confirmation" class="form-label">Повторите пароль</label>
                                                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                                                                @if ($errors->has('repeat_passwd'))
                                                                    <div class="text-danger">{{ $errors->first('repeat_passwd') }}</div>
                                                                @endif
                                                            </div>
                                                            <input class="btn btn-primary" type="submit" value="Сохранить">

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <div id="content">
                                                            <ul class="timeline">
                                                                @if($user->history->isEmpty())
                                                                    <h3 class="text-center">Данных нет</h3>
                                                                @else
                                                                    @foreach($user->history->sortByDesc('created_at') as $history)
                                                                        @php
                                                                            $changes = explode(';', $history->diff);
                                                                            $listItems = [];

                                                                            foreach ($changes as $change) {
                                                                                $change = trim($change);
                                                                                if (!empty($change)) {
                                                                                    $listItems[$change] = "{$change}";
                                                                                }
                                                                            }

                                                                            $tooltipContent = $listItems;
                                                                        @endphp
                                                                        <li class="event" data-date="{{ \Carbon\Carbon::parse($history->created_at)->format('d.m.Y H:i') }}">
                                                                            <h3>
                                                                                {{ $history->header }}
                                                                                @if(Str::contains("$history->header", 'Редактирование'))

                                                                                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable{{$history->id}}">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-diff" viewBox="0 0 16 16">
                                                                                            <path d="M8 5a.5.5 0 0 1 .5.5V7H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V8H6a.5.5 0 0 1 0-1h1.5V5.5A.5.5 0 0 1 8 5zm-2.5 6.5A.5.5 0 0 1 6 11h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                                                        </svg>
                                                                                        <span></span>
                                                                                    </a>
                                                                                    <!-- Вертикально центрированное модальное окно -->
                                                                                    <div class="modal fade" id="exampleModalScrollable{{$history->id}}" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" style="display: none;" aria-hidden="true">
                                                                                        <div class="modal-dialog modal-dialog-centered">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Внесенные изменения</h5>
                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                                                                                </div>
                                                                                                <ul class="m-4">
                                                                                                    @foreach($tooltipContent as $content)
                                                                                                        <li>
                                                                                                            {{ $content }}
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
