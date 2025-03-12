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
                                    <? } else {
                                        ?>
                                    <a href="/menu/{{$type->id}}">{{$type->menu_type}}</a>
                                    <? }
                                        ?>
                                @endforeach
                            </div>
                        </div>
                        <div class="menu__header_type text-body1-reg">|</div>
                        <div class="menu__header_type text-body1-med">{{$typeMenu->menu_type}} {{$typeMenu->time_type}}</div>

                    </div>
                    <div class="menu__content">
                        @foreach($lunches as $id_dish_l => $lunchesForIdDishL)
                            <div class="menu__content_item">
                                <div class="menu__content_item_header">
                                    <div class="text-body1-med">{{ $lunchesForIdDishL->first()->mainDish->dish_name }}</div>
                                    <div class="text-body2-reg">{{ $lunchesForIdDishL->first()->mainDish->cost }} Р.</div>
                                </div>
                                <div class="text-body2-reg">
                                    @php
                                        $dishNames = $lunchesForIdDishL->flatMap(function ($lunch) {
                                            return $lunch->dish ? [$lunch->dish->dish_name] : [];
                                        })->implode(', ');
                                    @endphp
                                    {{ $dishNames }}
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
