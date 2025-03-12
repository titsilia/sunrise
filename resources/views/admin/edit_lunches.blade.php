@extends('layouts.index')

@section('title', 'Добавление меню')
@section('content')
    <div class="admin-applications center">
        <x-header/>
        <div class="admin_menu">
            <form class="personal__info_form" action="/lunch_create" method="POST">
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
                <h2 class="text-h3-med">Добавление комбо</h2>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Наименование комбо</div>
                    <div class="inputs-container">
                        <input class="input @error('dish_name') input-error-field @enderror" type="text" name="dish_name" placeholder="Название комбо">

                        @error("dish_name")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Состав комбо</div>
                    <div class="inputs-container">
                        @foreach($Dishes as $Dish)

                            <div class="checkboxes-container">
                                <input class="@error('dishes') input-error-field @enderror" name="dishes[]" type="checkbox" value="{{$Dish->id}}" id="{{$Dish->id}}">
                                <label class="text-body3-reg" for="{{$Dish->id}}">{{$Dish->dish_name}}</label>
                            </div>

                        @endforeach
                        @error("dishes")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Цена комбо</div>
                    <div class="inputs-container">
                        <input class="input input-cost @error('cost') input-error-field @enderror" type="text" name="cost" placeholder="Цена комбо">

                        @error("cost")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Категория меню</div>
                    <div class="inputs-container">
                        @foreach($typeMenus as $typeMenu)
                                <?php if($typeMenu->id === 10) {
                                continue;
                            }
                                ?>
                            <div class="checkboxes-container">
                                <input class="@error('type_menus') input-error-field @enderror" name="type_menus[]" type="checkbox" value="{{$typeMenu->id}}" id="{{$typeMenu->id}}">
                                <label class="text-body3-reg" for="{{$typeMenu->id}}">{{$typeMenu->menu_type}}</label>
                            </div>

                        @endforeach
                        @error("type_menus")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <button class="button personal__info_form_button" type="submit">Добавить комбо</button>
            </form>
            <div class="admin_menu-container">
                <h2 class="text-h3-med">Управление комбо</h2>
                <div class="admin_menu__items">
                    <form class="edit__form" method="GET"  action="{{ route('updateFormLunch') }}">

                        <select name="id_dish" class="select">
                            @foreach($Lunches as $LunchForm)
                                <option value="{{$LunchForm->id}}">{{$LunchForm->dish_name}}</option>
                            @endforeach
                        </select>

                        <button class="button personal__info_form_button_select">Выбрать</button>
                    </form>

                    {{--                    @foreach($Dishes as $Dish)--}}
                    <form class="personal__info_form" action="/lunch_update/{{$Lunch ? $Lunch->id : ''}}" method="POST">
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
                            <div class="text-body2-med gray-pink">Номер комбо</div>
                            <div class="inputs-container text-body3-reg">
                                {{$Lunch ? $Lunch->id : ''}}
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Наименование комбо</div>
                            <div class="inputs-container">
                                <input class="input @error('edit_dish_name') input-error-field @enderror" type="text" value="{{$Lunch ? $Lunch->dish_name : ''}}" name="edit_dish_name" placeholder="Название комбо">

                                @error("edit_dish_name")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Состав комбо</div>
                            <div class="inputs-container">
                                @foreach($LunchDishesView as $LunchDish)

                                    <div class="checkboxes-container">
                                        <input class="@error('dishes') input-error-field @enderror" name="edit_dishes[]" type="checkbox" value="{{$LunchDish->id}}" id="edit_{{$LunchDish->id}}" @if($LunchDishes->contains($LunchDish->id)) checked @endif>
                                        <label class="text-body3-reg" for="edit_{{$LunchDish->id}}">{{$LunchDish->dish_name}}</label>
                                    </div>

                                @endforeach
                                @error("dishes")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Цена комбо</div>
                            <div class="inputs-container">
                                <input class="input @error('edit_cost') input-error-field @enderror" type="text" value="{{$Lunch ? $Lunch->cost : ''}}" name="edit_cost" placeholder="Цена комбо">

                                @error("edit_cost")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Категория меню</div>
                            <div class="inputs-container">
                                @foreach($typeMenus as $typeMenu)
                                        <?php if($typeMenu->id === 10) {
                                        continue;
                                    }
                                        ?>
                                    <div class="checkboxes-container">
                                        <input class="@error('type_menus') input-error-field @enderror" name="edit_type_menus[]" type="checkbox" value="{{$typeMenu->id}}" id="edit_{{$typeMenu->id}}" @if(in_array($typeMenu->id, $DishTypesMenuIds)) checked @endif>
                                        <label class="text-body3-reg" for="edit_{{$typeMenu->id}}">{{$typeMenu->menu_type}}</label>
                                    </div>

                                @endforeach
                                @error("type_menus")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button class="button personal__info_form_button" type="submit">Редактировать комбо</button>
                        <a href="/lunch_delete/{{$Lunch ? $Lunch->id : ''}}" class="button button-light personal__info_form_button">Удалить комбо</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-footer/>
@endsection('content')
