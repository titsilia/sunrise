@extends('layouts.index')

@section('title', 'Личный кабинет')
@section('content')
    <div class="menu center">
        <div class="menu-container">
            <x-header/>
            <div class="personal">
                <div class="personal__info">
                    <form class="personal__info_form" action="/personal_update" method="POST">
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
                        <h2 class="text-h3-med">Редактировать информацию</h2>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Имя</div>
                            <div class="inputs-container">
                                <input class="input @error('name') input-error-field @enderror" type="text" name="name" value="{{Auth::user()->name}}" placeholder="Имя">

                                @error("name")
                                    <div class="input-error-text" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Фамилия</div>
                            <div class="inputs-container">
                                <input class="input @error('surname') input-error-field @enderror" type="text" name="surname" value="{{Auth::user()->surname}}" placeholder="Фамилия">

                                @error("surname")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Отчество</div>
                            <div class="inputs-container">
                                <input class="input @error('patronymic') input-error-field @enderror" type="text" name="patronymic" value="{{Auth::user()->patronymic}}" placeholder="Отчество">

                                @error("patronymic")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Почта</div>
                            <div class="inputs-container">
                                <input class="input @error('email') input-error-field @enderror" type="text" name="email" value="{{Auth::user()->email}}" placeholder="Email">

                                @error("email")
                                    <div class="input-error-text" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Телефон</div>
                            <div class="inputs-container">
                                <input class="input @error('telephone') input-error-field @enderror" type="tel" name="telephone" v-maska
                            data-maska="###########" placeholder="+7" id="personal_tel" value="{{Auth::user()->telephone}}" placeholder="Введите пароль">

                                @error("telephone")
                                    <div class="input-error-text" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button class="button personal__info_form_button" type="submit">Редактировать информацию</button>
                    </form>
                    <div class="personal__info_block">
                        <h2 class="text-h3-med">Ваша информация</h2>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">ФИО</div>
                            <div class="text-body3-reg">{{Auth::user()->name}} {{Auth::user()->surname}} {{Auth::user()->patronymic}}</div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Почта</div>
                            <div class="text-body3-reg">{{Auth::user()->email}}</div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Телефон</div>
                            <div class="text-body3-reg">{{Auth::user()->telephone}}</div>
                        </div>
                    </div>
                </div>
                <div class="personal__applications">
                    <h2 class="text-h3-med">Ваши брони</h2>
                    <? if(count($applications) > 0) { ?>
                        <div class="personal__applications_container">

                            @foreach($applications as $application)
                            <a href="/personal_application/{{$application->id}}" class="personal__applications_item">
                                    <div class="personal__applications_item-container">
                                        <div class="text-body2-med gray-pink">Номер брони</div>
                                        <div class="text-body3-reg">{{$application->id}}</div>
                                    </div>
                                    <div class="personal__applications_item-container">
                                        <div class="text-body2-med gray-pink">Кол-во людей</div>
                                        <div class="text-body3-reg">{{$application->people}}</div>
                                    </div>
                                    <div class="personal__applications_item-container">
                                        <div class="text-body2-med gray-pink">Дата</div>
                                        <div class="text-body3-reg">{{$application->formatted_date}}</div>
                                    </div>
                                    <div class="personal__applications_item-container">
                                        <div class="text-body2-med gray-pink">Интервал</div>
                                        <div class="text-body3-reg">{{$application->time_interval}}</div>
                                    </div>
                                    <div class="personal__applications_item-container">
                                        <div class="text-body2-med gray-pink">Стол</div>
                                        <div class="text-body3-reg">{{$application->table_id}}</div>
                                    </div>
                                    <div class="personal__applications_item-container">
                                        <div class="text-body2-med gray-pink">Статус</div>
                                        <div class="text-body3-reg">{{$application->statusApp->type_status}}</div>
                                    </div>
                            </a>
                            @endforeach
                        </div>

                    <? } else { ?>
                        <div class="text-body2-med gray-pink">У вас нет бронь</div>
                     <? } ?>
                    <div class="articles__numbers">
                        {{ $applications->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>

        </div>
    </div>
    <x-footer/>
@endsection('content')
