@extends('layouts.index')

@section('title', 'Добавление меню')
@section('content')
    <div class="admin-applications center">
        <x-header/>
        <div class="admin_menu">
            <form class="personal__info_form" action="/type_dish_create" method="POST">
                @csrf
                @if(session('error1'))
                    <div class="input-error-text">
                        {{ session('error1') }}
                    </div>
                @endif
                @if(session('success1'))
                    <div class="input-success-text">
                        {{ session('success1') }}
                    </div>
                @endif
                <h2 class="text-h3-med">Добавление категории блюда</h2>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Наименование категории</div>
                    <div class="inputs-container">
                        <input class="input @error('dishes_type') input-error-field @enderror" type="text" name="dishes_type" placeholder="Название категории блюда">

                        @error("dishes_type")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <button class="button personal__info_form_button" type="submit">Добавить категорию</button>
            </form>
            <div class="admin_menu-container">
                <h2 class="text-h3-med">Управление категориями блюд</h2>
                <div class="admin_menu__items">
                    <form class="edit__form" method="GET" action="{{ route('updateFormTypeDish') }}">

                        <select name="id_type_dish" class="select">
                            @foreach($typeDishes as $typeDishForm)
                                <option value="{{$typeDishForm->id}}">{{$typeDishForm->dishes_type}}</option>
                            @endforeach
                        </select>

                        <button class="button personal__info_form_button_select">Выбрать</button>
                    </form>

                    {{--                    @foreach($typeDishes as $typeDish)--}}

                    <form class="personal__info_form" action="/type_dish_update/{{$TypeDish ? $TypeDish->id : ''}}" method="POST">
                        @if(session('error2'))
                            <div class="input-error-text">
                                {{ session('error2') }}
                            </div>
                        @endif
                        @if(session('success2'))
                            <div class="input-success-text">
                                {{ session('success2') }}
                            </div>
                        @endif
                        @csrf
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Номер категории</div>
                            <div class="inputs-container text-body3-reg">
                                {{$TypeDish? $TypeDish->id : ''}}
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Наименование категории</div>
                            <div class="inputs-container">
                                <input class="input @error('edit_dishes_type') input-error-field @enderror" type="text" value="{{$TypeDish ? $TypeDish->dishes_type : ''}}" name="edit_dishes_type" placeholder="Название категории меню">

                                @error("edit_dishes_type")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button class="button personal__info_form_button" type="submit">Редактировать категорию</button>
                        <a href="/type_dish_delete/{{$TypeDish ? $TypeDish->id : ''}}" class="button button-light personal__info_form_button">Удалить категорию</a>
                    </form>
                    {{--                    @endforeach--}}


                </div>
                {{--                <div class="articles__numbers">--}}
                {{--                    {{ $typeDishes->withQueryString()->links('pagination::bootstrap-5') }}--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <x-footer/>
@endsection('content')
