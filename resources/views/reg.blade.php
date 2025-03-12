@extends('layouts.index')

@section('title', 'Регистрация')
@section('content')
    <div class="auth center">
        <div class="auth-container">
            <x-header-white/>
            <form method="POST" action="/reg_user" class="auth__form">
                @csrf
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
                <h2 class="text-h2-med">Регистрация</h2>
                <div class="auth__form_items">
                    <div class="auth__form_inputs">
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
                        <div class="inputs-container">
                            <input class="input @error('confirm_password') input-error-field @enderror" type="password" name="confirm_password" placeholder="Повторите пароль">

                            @error("confirm_password")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="inputs-container">
                            <input class="input @error('telephone') input-error-field @enderror" id="reg_tel" type="tel" name="telephone" v-maska
                            data-maska="8##########" placeholder="Номер телефона">

                            @error("telephone")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="inputs-container">
                            <input class="input @error('name') input-error-field @enderror" type="text" name="name" placeholder="Имя">

                            @error("name")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="inputs-container">
                            <input class="input @error('surname') input-error-field @enderror" type="text" name="surname" placeholder="Фамилия">

                            @error("surname")
                            <div class="input-error-text" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="inputs-container">
                            <input class="input @error('patronymic') input-error-field @enderror" type="text" name="patronymic" placeholder="Отчество">

                            @error("patronymic")
                            <div class="input-error-text" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="auth__form_inputs">
                        <button class="button">Регистрация</button>
                        <a href ="/auth" class="button button-light">Войти</a>
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
