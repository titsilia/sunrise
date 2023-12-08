@extends('layouts.index')
@extends('layouts.index')

@section('title', 'Авторизация')
@section('content')
    <div class="auth center">
        <div class="auth-container">
            <x-header-white/>
            <form action="" class="auth__form">
                <h2 class="text-h2-med">Регистрация</h2>
                <div class="auth__form_items">
                    <div class="auth__form_inputs">
                        <input class="input" type="text" name="reg-email", placeholder="Email">
                        <input class="input" type="password" name="reg-password", placeholder="Введите пароль">
                        <input class="input" type="password" name="reg-repeat-password", placeholder="Повторите пароль">
                        <input class="input" type="tel" name="reg-tel", placeholder="Номер телефона">
                        <input class="input" type="text" name="reg-fio", placeholder="Фамилия, имя, отчество">
                    </div>
                    <div class="auth__form_inputs">
                        <button class="button">Регистрация</button>
                        <a href ="/reg" class="button button-light">Войти</a>
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