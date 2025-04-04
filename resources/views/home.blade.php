@extends('layouts.template')

@section('title')
    Главная
@endsection

@section('content')
    <div class="container">
        <div class="container-fluid">
            <h5 class="my-4">Просмотр журнала учета пациентов
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-log-text" viewBox="0 0 16 16">
                    <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                </svg>
            </h5>
            <p class="card-text">На этой странице отображается краткая информация о пациентах.
                При необходимости просмотра полной информации нажмите на соответствующую кнопку.</p>
         </div>
    </div>
    <div class="container text-white blurBG" style="justify-content: center; width: 50vw; border-radius: 7px">
        @if ($errors->has('destroy_error'))
            <div class="card">
                <div class="card_body">
                    <div class="card-header">
                        <p>Ошибка данных</p>
                    </div>
                    <p>{{ $errors->first('destroy_error') }}</p>
                </div>
            </div>
        @endif
    </div>

    <div class="container">

        <table class="table table-bordered my-4">
            <thead>
            <tr>
                <td>Дата поступления</td>
                <td>Время поступления</td>
                <td>Фамилия, имя, отчество (при наличии)</td>
                <td>Дата рождения (число, месяц, год)</td>
                <td>Номер медицинской карты</td>
                <td>Исход госпитализации, дата и время исхода, наименование медицинской организации, куда переведен пациент</td>
                <td>Просмотр полной информации</td>
            </tr>
            </thead>
            <tbody>
                @if($logs)
                    @foreach($logs as $log)
                        <tr>
                            @if($log->logReceipt)
                                <td>{{ $log->logReceipt->date_receipt }}</td>
                                <td> {{ $log->logReceipt->time_receipt }} </td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            @if($log->patient)
                                <td>{{ $log->patient->name }}</td>
                                <td>{{ $log->patient->birth_day }}</td>
                                <td> {{ $log->patient->medical_card }}</td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                            <td>
                                @if($log->logDischarge)
                                    @if($log->logDischarge->outcome != null)
                                        Пациент {{ $log->logDischarge->outcome }}
                                    @endif
                                    {{ $log->logDischarge->datetime_discharge }}
                                    {{ $log->logDischarge->section_transferred }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('log.show', ['id' => $log->id]) }}" class="btn btn-primary" role="button">
                                    Просмотр
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
