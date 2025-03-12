@extends('layouts.index')

@section('title', 'Бронирование')
@section('content')
    <div class="application center">
        <div class="menu-container">
            <x-header-white/>
            <div class="application__application">
                <h2 class="text-h3-med">Бронирование стола</h2>
                @if(Auth::check())

                    <form class="personal__info_form" action="/application_create" method="POST">
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
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Дата</div>
                            <div class="inputs-container">
                                <input class="input input-date @error('date') input-error-field @enderror" type="date" name="date" placeholder="Время">

                                @error("date")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Время</div>
                            <div class="inputs-container">
                                <select class="input @error('time') input-error-field @enderror" name="time">
                                    <option value="" selected disabled>Выберите время</option>
                                    <option value="12:00:00.0000">12:00</option>
                                    <option value="13:00:00.0000">13:00</option>
                                    <option value="14:00:00.0000">14:00</option>
                                    <option value="15:00:00.0000">15:00</option>
                                    <option value="16:00:00.0000">16:00</option>
                                    <option value="17:00:00.0000">17:00</option>
                                    <option value="18:00:00.0000">18:00</option>
                                    <option value="19:00:00.0000">19:00</option>
                                    <option value="20:00:00.0000">20:00</option>
                                    <option value="21:00:00.0000">21:00</option>
                                    <option value="22:00:00.0000">22:00</option>
                                </select>
                                @error("time")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Интервал пребывания пребывания</div>
                            <div class="inputs-container">
                                <select class="input @error('time_interval') input-error-field @enderror" name="time_interval">
                                    <option value="" selected disabled>Выберите интервал пребывания</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>

                                @error("time_interval")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Номер стола</div>
                            <div class="inputs-container">
                                <select class="input @error('table_id') input-error-field @enderror" name="table_id">
                                    <option value="" selected disabled>Выберите номер стола</option>
                                    @foreach($tables as $table)
                                        <option value="{{$table->id}}">Стол №{{$table->id}}, количество человек: {{$table->max_people}}</option>

                                    @endforeach
                                </select>
                                @error("table_id")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Количество персон</div>
                            <div class="inputs-container">
                                <select class="input @error('people') input-error-field @enderror" name="people">
                                    <option value="" selected disabled>Выберите количество персон</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                                @error("people")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button class="button personal__info_form_button" type="submit">Забронировать</button>
                    </form>
                @else
                    <form class="personal__info_form" action="/guest_application_create" method="POST">
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
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Дата</div>
                            <div class="inputs-container">
                                <input class="input input-date @error('date') input-error-field @enderror" type="date" name="date" placeholder="Время">

                                @error("date")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Время</div>
                            <div class="inputs-container">
                                <select class="input @error('time') input-error-field @enderror" name="time">
                                    <option value="" selected disabled>Выберите время</option>
                                    <option value="12:00:00.0000">12:00</option>
                                    <option value="13:00:00.0000">13:00</option>
                                    <option value="14:00:00.0000">14:00</option>
                                    <option value="15:00:00.0000">15:00</option>
                                    <option value="16:00:00.0000">16:00</option>
                                    <option value="17:00:00.0000">17:00</option>
                                    <option value="18:00:00.0000">18:00</option>
                                    <option value="19:00:00.0000">19:00</option>
                                    <option value="20:00:00.0000">20:00</option>
                                    <option value="21:00:00.0000">21:00</option>
                                    <option value="22:00:00.0000">22:00</option>
                                </select>
                                @error("time")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Интервал пребывания</div>
                            <div class="inputs-container">
                                <select class="input @error('time_interval') input-error-field @enderror" name="time_interval">
                                    <option value="" selected disabled>Выберите интервал</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>

                                @error("time_interval")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Номер стола</div>
                            <div class="inputs-container">
                                <select class="input @error('table_id') input-error-field @enderror" name="table_id">
                                    <option value="" selected disabled>Выберите номер стола</option>
                                    @foreach($tables as $table)
                                        <option value="{{$table->id}}">Стол №{{$table->id}}, количество человек: {{$table->max_people}}</option>

                                    @endforeach
                                </select>
                                @error("table_id")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Количество персон</div>
                            <div class="inputs-container">
                                <select class="input @error('people') input-error-field @enderror" name="people">
                                    <option value="" selected disabled>Выберите количество персон</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                                @error("people")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="inputs-container">
                            <div class="text-body2-med gray-pink">Имя</div>
                            <input class="input @error('name') input-error-field @enderror" type="text" name="name" placeholder="Имя">

                            @error("name")
                            <div class="input-error-text" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="inputs-container">
                            <div class="text-body2-med gray-pink">Почта</div>
                            <input class="input @error('email') input-error-field @enderror" type="text" name="email" placeholder="Email">

                            @error("email")
                            <div class="input-error-text" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="inputs-container">
                            <div class="text-body2-med gray-pink">Номер телефона</div>
                            <input class="input @error('telephone') input-error-field @enderror" id="reg_tel" type="tel" name="telephone" v-maska
                                   data-maska="8##########" placeholder="Номер телефона">

                            @error("telephone")
                            <div class="input-error-text" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <button class="button personal__info_form_button" type="submit">Забронировать</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <x-footer/>
@endsection('content')
