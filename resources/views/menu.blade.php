@extends('layouts.index')

@section('title', 'Меню')
@section('content')
    <div class="menu center">
        <div class="menu-container">
            <x-header/>
            <div class="menu__menu">
                <h2 class="text-h3-med">Меню</h2>
                <div class="menu__block text-white">
                    <div class="menu__header">
                        <div class="menu__header_views">
                            <div class="menu__header_views_title text-body1-reg">
                                <div>ВИДЫ МЕНЮ</div>
                                <svg class="menu__header_views_arrow" width="28" height="28" viewBox="0 0 28 28" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.0002 8.40002L14.0002 15.4L21.0002 8.40002L23.8002 9.80002L14.0002 19.6L4.2002 9.80002L7.0002 8.40002Z"
                                        fill="white"/>
                                </svg>
                            </div>
                            <div class="menu__header_views_ul text-body22-reg">
                                @foreach($typesMenu as $type)
                                        <?php if($type->id === 16) { ?>
                                    <a href="/menu_lunch">{{$type->menu_type}}</a>
                                    <?php } else {
                                        ?>
                                    <a href="/menu/{{$type->id}}">{{$type->menu_type}}</a>
                                    <?php }
                                        ?>
                                @endforeach
                            </div>
                        </div>
                        <div class="menu__header_type text-body1-reg">|</div>
                        <div class="menu__header_type text-body1-med">{{$typeMenu->menu_type}} {{$typeMenu->time_type}}</div>

                    </div>
                    <div class="menu__content">
                        @foreach ($typeDishes as $typeDish)
                            <div class="menu__content_section">
                                <div class="menu__content_title text-body1-med">{{$typeDish->dishes_type}}</div>
                                <div class="menu__content_items">
                                    @foreach($dishes[$typeDish->id] as $dish)
                                        <div class="menu__content_item">
                                            <div class="menu__content_item_header">
                                                <div class="text-body1-med">{{$dish->dish_name}}</div>
                                                <div class="text-body2-reg">{{$dish->cost}} Р.</div>
                                            </div>
                                            <div class="menu__content_item_header">
                                                <div class="text-body2-reg">{{$dish->dish_desc}}</div>
                                                <div class="text-body2-reg">{{$dish->weight}} гр.</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer/>
@endsection('content')
