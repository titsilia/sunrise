@extends('layouts.index')

@section('title', 'Авторизация')
@section('content')
    <div class="auth center">
        <div class="auth-container">
            <x-header-white/>
            <form action="" class="auth__form">
                <h2 class="text-h2-med">Авторизация</h2>
                <div class="auth__form_items">
                    <div class="auth__form_inputs">
                        <input class="input" type="text" name="authEmail", placeholder="Email">
                        <input class="input" type="password" name="authPassword", placeholder="Введите пароль">
                    </div>
                    <div class="auth__form_inputs">
                        <button class="button">Войти</button>
                        <a href ="/reg" class="button button-light">Регистрация</a>
                    </div>
                </div>

            </form>
        </div>
        
        <div class="main__footer text-body3-reg">
            <a href="#">2023, Stolitsa Group</a>
            <a href="#">VK</a>
            <a href="#">Telegramm</a>
        </div>  
    </div>
@endsection('content')