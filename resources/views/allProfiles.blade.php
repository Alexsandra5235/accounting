@extends('layouts.template')

@section('title')
    Управление пользователями
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('register') }}" class="btn btn-secondary">Добавить пользователя</a>
        @foreach($users as $user)
            <div class="card my-4">
                <div class="row justify-content-start">
                    <div class="col-2 m-2">
                        <header class="container text-center">
                            <div class="avatar">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                     class="rounded-circle img-fluid" style="width: 150px;">
                            </div>
                            <h3>{{ $user->name }}</h3>
                        </header>
                    </div>
                    <div class="col-2 m-4 text-left">
                        <p>Почта пользователя: {{ $user->email }}</p>
                        <p>Дата создания аккаунта: {{ $user->created_at }}</p>
                        <p>Роль пользователя: {{ $user->getRoleNames()->first() }}</p>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection
