@extends('layouts.index')

@section('title', 'Добавление меню')
@section('content')
    <div class="admin-applications center">
        <x-header/>
        <div class="admin_menu">
            <form class="personal__info_form" action="/dish_create" method="POST">
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
                <h2 class="text-h3-med">Добавление блюда</h2>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Наименование блюда</div>
                    <div class="inputs-container">
                        <input class="input @error('dish_name') input-error-field @enderror" type="text" name="dish_name" placeholder="Название блюда">

                        @error("dish_name")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Состав блюда</div>
                    <div class="inputs-container">
                        <input class="input @error('dish_desc') input-error-field @enderror" type="text" name="dish_desc" placeholder="Состав блюда">

                        @error("dish_desc")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Цена блюда</div>
                    <div class="inputs-container">
                        <input class="input input-cost @error('cost') input-error-field @enderror" type="text" name="cost" placeholder="Цена блюда">

                        @error("cost")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Вес блюда, граммы</div>
                    <div class="inputs-container">
                        <input class="input input-cost @error('weight') input-error-field @enderror" type="text" name="weight" placeholder="Вес блюда">

                        @error("weight")
                        <div class="input-error-text" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="personal__info_block-container">
                    <div class="text-body2-med gray-pink">Категория блюда</div>
                    <div class="inputs-container">
                        <select class="select @error('type_dishes') input-error-field @enderror" name="type_dishes">
                            @foreach($typeDishes as $typeDish)
                                <option value="{{$typeDish->id}}">{{$typeDish->dishes_type}}</option>
                            @endforeach
                        </select>
                        @error("type_dishes")
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
                <button class="button personal__info_form_button" type="submit">Добавить блюдо</button>
            </form>
            <div class="admin_menu-container">
                <h2 class="text-h3-med">Управление блюдами</h2>
                <div class="admin_menu__items">
                    <form class="edit__form" method="GET"  action="{{ route('updateFormDish') }}">

                        <select name="id_dish" class="select">
                            @foreach($Dishes as $DishForm)
                                <option value="{{$DishForm->id}}">{{$DishForm->dish_name}}</option>
                            @endforeach
                        </select>

                        <button class="button personal__info_form_button_select">Выбрать</button>
                    </form>

                    {{--                    @foreach($Dishes as $Dish)--}}
                    <form class="personal__info_form" action="/dish_update/{{$Dish ? $Dish->id : ''}}" method="POST">
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
                            <div class="text-body2-med gray-pink">Номер блюда</div>
                            <div class="inputs-container text-body3-reg">
                                {{$Dish ? $Dish->id : ''}}
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Наименование блюда</div>
                            <div class="inputs-container">
                                <input class="input @error('edit_dish_name') input-error-field @enderror" type="text" value="{{$Dish ? $Dish->dish_name : ''}}" name="edit_dish_name" placeholder="Название категории меню">

                                @error("edit_dish_name")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Состав блюда</div>
                            <div class="inputs-container">
                                <div class="text-body4-reg">Пожалуйста, не забывайте ставить точки между продуктами!</div>
                                <input class="input @error('edit_dish_desc') input-error-field @enderror" type="text" value="{{$Dish ? $Dish->dish_desc : ''}}" name="edit_dish_desc" placeholder="Название категории меню">

                                @error("edit_dish_desc")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Цена блюда</div>
                            <div class="inputs-container">
                                <input class="input @error('edit_cost') input-error-field @enderror" type="text" value="{{$Dish ? $Dish->cost : ''}}" name="edit_cost" placeholder="Название категории меню">

                                @error("edit_cost")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="personal__info_block-container">
                            <div class="text-body2-med gray-pink">Вес блюда, граммы</div>
                            <div class="inputs-container">
                                <input class="input input-cost @error('edit_weight') input-error-field @enderror" type="text" name="edit_weight" value="{{$Dish ? $Dish->weight  : ''}}" placeholder="Вес блюда">

                                @error("edit_weight")
                                <div class="input-error-text" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="admin_menu__info_block-container">
                            <div class="text-body2-med gray-pink">Категория блюда</div>
                            <div class="inputs-container">
                                <select class="select @error('edit_type_dishes') input-error-field @enderror" name="edit_type_dishes">

                                    <option value="{{$Dish ? $Dish->type_dishes : ''}}" selected>{{$Dish ? $Dish->typeDish->dishes_type : ''}}</option>
                                    @foreach($typeDishesAll as $typeDish)
                                        @if($Dish && $typeDish->id !== $Dish->type_dishes)
                                        <option value="{{$typeDish->id}}">{{$typeDish->dishes_type}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error("edit_type_dishes")
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
                        <button class="button personal__info_form_button" type="submit">Редактировать блюдо</button>
                        <a href="/dish_delete/{{$Dish ? $Dish->id : ''}}" class="button button-light personal__info_form_button">Удалить блюдо</a>
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
