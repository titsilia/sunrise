@extends('layouts.index')

@section('title', 'Добавление меню')
@section('content')
    <div class="admin-applications center">
        <x-header/>
        <div class="admin_menu">
            <form class="personal__info_form" action="/type_menu_create" method="POST">
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
                <h2 class="text-h3-med">Добавление категории меню</h2>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Наименование категории</div>
                    <div class="inputs-container">
                        <input class="input @error('menu_type') input-error-field @enderror" type="text" name="menu_type" placeholder="Название категории меню">

                        @error("menu_type")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Время меню</div>
                    <div class="inputs-container">
                        <select class="input @error('time_type') input-error-field @enderror" name="time_type">
                            <option value="8:00 — 23:00">8:00 - 23:00</option>
                            <option value="8:00 — 12:00">8:00 — 12:00</option>
                            <option value="12:00 — 18:00">12:00 — 18:00</option>
                            <option value="12:00 — 16:00">12:00 — 16:00</option>
                            <option value="18:00 — 23:00">18:00 — 23:00</option>
                        </select>
                        @error("time_type")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <button class="button personal__info_form_button" type="submit">Добавить категорию</button>
            </form>
            <div class="admin_menu-container">
                <h2 class="text-h3-med">Управление категориями меню</h2>
                <div class="admin_menu__items">

                    <form class="edit__form" method="GET" action="{{ route('updateFormTypeMenu') }}">

                        <select name="id_type_menu" class="select">
                            @foreach($typeMenus as $TypeMenuForm)
                                    <?php if($TypeMenuForm->id === 10) {
                                    continue;
                                }
                                    ?>
                                <option value="{{$TypeMenuForm->id}}">{{$TypeMenuForm->menu_type}}</option>
                            @endforeach
                        </select>

                        <button class="button personal__info_form_button_select">Выбрать</button>
                    </form>
                    {{--                    @foreach($typeMenus as $TypeMenu)--}}
                    <form class="personal__info_form" action="/type_menu_update/{{$TypeMenu ? $TypeMenu->id : ''}}" method="POST">
                        @csrf
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
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Номер категории</div>
                            <div class="inputs-container text-body3-reg">
                                {{$TypeMenu ? $TypeMenu->id : ''}}
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Наименование категории</div>
                            <div class="inputs-container">
                                <input class="input @error('edit_menu_type') input-error-field @enderror" type="text" value="{{$TypeMenu ? $TypeMenu->menu_type : ''}}" name="edit_menu_type" placeholder="Название категории меню">

                                @error("edit_menu_type")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Время меню</div>
                            <div class="inputs-container">
                                <input class="input @error('edit_time_type') input-error-field @enderror" type="text" value="{{$TypeMenu ? $TypeMenu->time_type : ''}}" name="edit_time_type" placeholder="Время категории меню">
                                @error("edit_time_type")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button class="button personal__info_form_button" type="submit">Редактировать категорию</button>
                        <a href="/type_menu_delete/{{$TypeMenu ? $TypeMenu->id : ''}}" class="button button-light personal__info_form_button">Удалить категорию</a>
                    </form>
                    {{--                    @endforeach--}}


                </div>
                {{--                <div class="articles__numbers">--}}
                {{--                    {{ $typeMenus->withQueryString()->links('pagination::bootstrap-5') }}--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <x-footer/>
@endsection('content')
