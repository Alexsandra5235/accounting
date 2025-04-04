@extends('layouts.template')

@section('title')
    Главная
@endsection

@section('content')
    <h1>Поиск по МКБ-10</h1>
    <div style="position: relative;">
        <input type="text" id="example" placeholder="Введите название болезни..." />
        <div id="suggestions"></div>
    </div>


@endsection
