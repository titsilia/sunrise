<div>
    <div class="header text-white">
        <a href="/"><h1 class="text-h1">РАССВЕТ</h1></a>
        <div class="header__nav text-body3-reg text-white">
            <a href="/aboutus">о нас</a>
            <a href="/menu">меню</a>
            <a href="/application">бронирование</a>
            @guest
                <a href="/auth">вход</a>
                <a href="/reg">регистрация</a>
            @endguest
            @auth
                <a href="/personal">личный кабинет</a>
                <a href="/admin">админ-панель</a>
                <a href="/exit">выход</a>
            @endauth
        </div>
    </div>
</div>