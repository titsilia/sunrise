@extends('layouts.index')

@section('title', 'Брони')
@section('content')
    <div class="admin-applications center">
        <x-header/>
        <div class="admin-applications__item_info text-body1-med">
            <a href="?status=1">НА РАССМОТРЕНИИ</a>
            <a href="?status=2">ПРИНЯТО</a>
            <a href="?status=3">ОТКЛОНЕНО</a>
        </div>
        <div class="admin-applications-container">
            <? if(count($groupedApplications) > 0) { ?>
            <table>
                <thead>
                <tr>
                    <th>№ Брони</th>
                    <th>Дата, интервал посещения</th>
                    <th>Стол, кол-во человек</th>
                    <th>Клиент, почта</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($groupedApplications as $date => $applications)
                        <tr class="first-tr"><td colspan="6">
                                <h2 class="text-body1-reg">{{ $date }}</h2></td>
                        </tr>
                        @foreach($applications as $application)
                            <tr class="text-body3-reg">
                                <td>{{$application->id}}</td>
                                <td>
                                    <span>{{ $application->day_of_week }}, {{ $application->formatted_date }} {{ $application->formatted_time }}, {{ $application->time_interval }} ч.</span>
                                </td>
                                <td>
                                    № {{ $application->table_id }}, {{ $application->people }} чел.
                                </td>
                                <td>
                                    <span class="first-td">{{ $application->name }}</span><br>
                                    <span>{{$application->email}}</span>
                                </td>
                                <td>
                                    {{ $application->statusApp->type_status }}
                                </td>
                                <td>
                                    @if($application->status_app === 1)
                                    <a href="/admin_applications/{{ $application->id }}/confirm" class="button-mini">Принять</a>
                                    <a href="/admin_applications/{{ $application->id }}/deny" class="button-mini button-dark-red">Отклонить</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>


            <? } else { ?>
                <h2 class="text-h1-med">Нет бронь на рассмотрение</h2>
            <? } ?>


        </div>
    </div>
    <x-footer/>
@endsection('content')
