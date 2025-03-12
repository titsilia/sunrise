@extends('layouts.index')

@section('title', 'Личный кабинет')
@section('content')
    <div class="menu center">
        <div class="menu-container">
            <x-header/>
            <div class="personal">
                <div class="personal__application">
                    <h2 class="text-h3-med">Бронь №{{$application->id}}</h2>
                        <div class="personal__application_container">
                                    <div class="personal__application_item-container">
                                        <div class="text-body2-med gray-pink">Кол-во людей</div>
                                        <div class="text-body3-reg">{{$application->people}}</div>
                                    </div>
                                    <div class="personal__application_item-container">
                                        <div class="text-body2-med gray-pink">Дата</div>
                                        <div class="text-body3-reg">{{$application->formatted_date}}</div>
                                    </div>
                                    <div class="personal__application_item-container">
                                        <div class="text-body2-med gray-pink">Интервал</div>
                                        <div class="text-body3-reg">{{$application->time_interval}}</div>
                                    </div>
                                    <div class="personal__application_item-container">
                                        <div class="text-body2-med gray-pink">Стол</div>
                                        <div class="text-body3-reg">{{$application->table_id}}</div>
                                    </div>
                                    <div class="personal__application_item-container">
                                        <div class="text-body2-med gray-pink">Статус</div>
                                        <div class="text-body3-reg">{{$application->statusApp->type_status}}</div>
                                    </div>
                                    <div class="personal__application_item-container">
                                        <div class="text-body2-med gray-pink">Блюда в заказе:</div>
                                        <div class="text-body3-reg">{{$application->statusApp->type_status}}</div>
                                    </div>
                                @if($application->status_app === 1)
                                    <div class="admin-applications__item_button personal__application_item_button">
                                        <a href="/admin_applications/{{$application->id}}/deny" class="button-mini button-dark-red">Отклонить</a>
                                    </div>
                                @endif
                        </div>

                </div>
                @if($application->status_app === 1)
                    <div class="personal__application">
                        <h2 class="text-h3-med">Предзаказ блюд</h2>
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
                        <div class="menu__menu">
                            <div class="menu__block personal__application_menu__block text-white">
                                <div class="menu__content">
                                    @foreach ($typeDishes as $typeDish)
                                        <div class="menu__content_section">
                                            <div class="menu__content_title text-body1-med">{{$typeDish->dishes_type}}</div>
                                            <div class="menu__content_items">
                                                @foreach($dishes[$typeDish->id] as $dish)
                                                    <form action="/app_dish_add/{{$dish->id}}?appId={{$application->id}}" class="personal__application_form">
                                                        @csrf

                                                        <div class="menu__content_item">
                                                            <div class="menu__content_item_header">
                                                                <div class="text-body1-med">{{$dish->dish_name}}</div>
                                                                <div class="text-body2-reg">{{$dish->cost}} Р.</div>
                                                            </div>
                                                            <div class="text-body2-reg">{{$dish->dish_desc}}</div>
                                                        </div>
                                                        <div class="inputs-container personal__application_form_input">
                                                            <input class="input personal__application_form_input @error('count') input-error-field @enderror" type="number" min="1" value="1" name="count" placeholder="Количество">
                                                            <input name="app_id" value="{{$application->id}}" type="hidden">
                                                            @error("count")
                                                            <div class="input-error-text" role="alert">
                                                                {{$message}}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        <button class="button personal__info_form_button" type="submit">Добавить в заказ</button>
                                                    </form>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>

        </div>
    </div>
    <x-footer/>
@endsection('content')
