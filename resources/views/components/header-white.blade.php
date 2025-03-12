
<div class="header text-white">
    <a href="/"><h1 class="text-h1">РАССВЕТ</h1></a>
    <div class="header__nav-container">
        <div class="header__nav text-body3-reg text-white">
                <a href="/aboutus">О нас</a>
                <a href="/menu/1">Меню</a>
                <a href="/application">Бронирование</a>
                @guest
                    <a href="/auth">Вход</a>
                    <a href="/reg">Регистрация</a>
                @endguest
                @auth
                    <a href="/personal">Личный кабинет</a>
                    <a href="/exit">Выход</a>
                @endauth
        </div>
        @auth
            <?php if(auth()->user()->role_id === 1) { ?>
                <div class="header__nav text-body3-reg">
                    <a href="/admin_applications">Брони</a>
                    <a href="/admin_control">Панель управления меню</a>
{{--                    <a href="/admin_add_menu">добавление меню</a>--}}
{{--                    <a href="/admin_edit_menu"  class="header__nav_links"><span>редактирование</span> <span>и удаление меню</span></a>--}}
                </div>
            <?php } ?>
        @endauth
    </div>
</div>
