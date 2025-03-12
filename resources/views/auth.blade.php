@extends('layouts.index')

@section('title', 'Авторизация')
@section('content')
    <div class="auth center">
        <div class="auth-container">
            <x-header-white/>
            <form  method="POST" action="/auth_user" class="auth__form">
                @csrf
                <h2 class="text-h2-med">Авторизация</h2>
                <div class="auth__form_items">
                    <div class="auth__form_inputs">
                        @if(session('error'))
                            <div class="input-error-text">
                                {{ session('error') }}
                            </div>
                        @endif
                            @if(session('success'))
                                <div class="input-success-text">
                                    {{ session('success') }}
                                </div>
                            @endif
                        <div class="inputs-container">
                            <input class="input @error('email') input-error-field @enderror" type="text" name="email" placeholder="Email">

                            @error("email")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="inputs-container">
                            <input class="input @error('password') input-error-field @enderror" type="password" name="password" placeholder="Введите пароль">

                            @error("password")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="auth__form_inputs">
                        <button class="button">Войти</button>
                        <a href ="/reg" class="button button-light">Регистрация</a>
                    </div>
                </div>

            </form>
        </div>

        <div class="main__footer text-body3-reg">
            <a href="#">2024, Stolitsa Group</a>
            <a href="#">VK</a>
            <a href="#">Telegramm</a>
        </div>
    </div>
@endsection('content')
