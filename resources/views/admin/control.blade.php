@extends('layouts.index')

@section('title', 'Панель управления')
@section('content')
    <div class="admin-applications center">
        <x-header/>
        <div class="admin-applications-container text-h3-med">
            <a href="/admin_edit_types_menu">Управление категориями меню</ a>
            <a href="/admin_edit_types_dishes">Управление категориями блюд</a>
            <a href="/admin_edit_dishes">Управление блюдами</a>
            <a href="/admin_edit_lunches">Управление комбо</a>
        </div>
    </div>
    <x-footer/>
@endsection('content')
