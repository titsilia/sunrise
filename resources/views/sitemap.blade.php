@extends('layouts.index')

@section('title', 'Рассвет')
@section('content')
    <div class="sitemap center">
        <h1 class="text-h2-med">Карта сайта</h1>
        <div class="sitemap__container">
            <div class="sitemap__container_item">
                <h2 class="text-h3-med">Главная</h2>
                <div class="sitemap__container_item-container">
                    <a class="text-body1-reg sitemap__container_item_link" href="/">Главная</a>
                    <a class="text-body1-reg sitemap__container_item_link" href="/aboutus">О нас</a>
                    <a class="text-body1-reg sitemap__container_item_link" href="/menu">Меню</a>
                    <a class="text-body1-reg sitemap__container_item_link" href="/applications">Бронирование</a>
                </div>
            </div>
            <div class="sitemap__container_item">
                <h2 class="text-h3-med">Авторизация</h2>
                <div class="sitemap__container_item-container">
                    <a class="text-body1-reg sitemap__container_item_link" href="/auth">Вход</a>
                    <a class="text-body1-reg sitemap__container_item_link" href="/reg">Регистрация</a>
                    <a class="text-body1-reg sitemap__container_item_link" href="/personal">Личный кабинет</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection('content')