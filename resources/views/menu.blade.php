@extends('layouts.index')

@section('title', 'О "Рассвет"')
@section('content')
    <div class="menu center">
        <div class="menu-container">
            <x-header/>
            <div class="menu__menu">
                <h2 class="text-h3-med">Меню</h2>
                <div class="menu__block"></div>
            </div>
        </div>
    </div>
    <x-footer/>
@endsection('content')