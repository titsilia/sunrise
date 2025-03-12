@extends('layouts.index')

@section('title', 'Рассвет')
@section('content')
    <div class="main center">
        <div class="main__header text-white">
            <h1 class="text-h1">РАССВЕТ</h1>
            <div class="text-body2-reg text-white">Уфа</div>
        </div>
        <div class="main__footer text-body3-reg">
            <a href="#">2024, Stolitsa Group</a>
            <a href="#">VK</a>
            <a href="#">Telegramm</a>
        </div>
    </div>
    <script>
        document.querySelector('.main').addEventListener('click', () => {
            location.href = "/aboutus"
        })
    </script>
@endsection('content')
