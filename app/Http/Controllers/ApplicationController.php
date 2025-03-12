<?php

namespace App\Http\Controllers;

use App\Models\TypeDish;
use App\Models\TypeMenu;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\ApplicationMenu;
use App\Models\Dish;
use App\Models\Table;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    public function application() {
        $tables = Table::all();
        return view("application", [
            'tables' => $tables,
        ]);
    }

    public function application_create(Request $request) {
        // Получаем текущее время
        $currentTime = (new DateTime('now', new DateTimeZone('Asia/Yekaterinburg')))->format('H:i:s');

        $applicationInfo = $request->validate([
            "date"=> "required|date|after_or_equal:today",
            "time"=> "required",
            "time_interval"=> "required",
            "people"=> "required",
            "table_id"=>"required"
            ],
            [
                "date.required" => "Поле обязательно для заполнения!",
                "date.after_or_equal" => "Нельзя записаться на прошлые даты!",
                "time.required" => "Поле обязательно для заполнения!",

                "time_interval.required" => "Поле обязательно для заполнения!",

                "people.required" => "Поле обязательно для заполнения!",
                "table_id.required" => "Поле обязательно для заполнения!",
        ]);

        $selectedDate = $applicationInfo['date'];
        $selectedTime = $applicationInfo['time'];
        $timeInterval = $applicationInfo['time_interval'];
        $closingTime = '24:00:00.0000';

        $selectedDateTime = Carbon::createFromFormat('Y-m-d H:i:s.u', $selectedDate . ' ' . $selectedTime);
        $endDateTime = $selectedDateTime->copy()->addHours($timeInterval)->addMinutes($timeInterval * 60 % 60);

        $today = date('Y-m-d');

        if ($selectedDate == $today) {
            // Если выбранная дата - сегодняшняя дата, проверяем время

            if ($selectedTime < $currentTime) {
                // Если выбранное время меньше текущего времени, возвращаем ошибку валидации
                return back()->withErrors(['time' => 'Нельзя выбрать время, которое уже прошло.']);
            }
        }
        if ($endDateTime->format('H:i:s') > $closingTime) {
            return back()->withErrors(['time_interval' => 'Выбранный интервал посещения выходит за пределы времени закрытия ресторана.']);
        }


        $table = $applicationInfo['table_id'];
        $tableRow = Table::find($table);

        $people = $applicationInfo['people'];

        if($tableRow->max_people < $people) {
            return back()->withErrors(['people' => 'Недопустимое количество человек для данного стола. Допустимое - ' . $tableRow->max_people . '.']);
        }

        $date = $applicationInfo['date'] . ' ' . $applicationInfo['time'];

        $existingBooking = Application::where('table_id', $applicationInfo['table_id'])
        ->where('date',  $date)
        ->where('time_interval', $applicationInfo['time_interval'])->where('status_app', '!=', '3')
        ->first();

        if ($existingBooking) {
            // Если бронь уже существует, выводим сообщение об ошибке
            return back()->with('error', 'Данный стол уже забронирован в выбранное время.');
        } else {
            $user = Auth::user();
            $userId = $user->id;
            $name = $user->surname . ' ' . $user->name . ' ' . $user->patronymic;
            $email = $user->email;

            $application_create= Application::create([
                "date"=>  $date,
                "time_interval"=> $applicationInfo["time_interval"],
                "people"=> $applicationInfo["people"],
                "table_id"=> $applicationInfo["table_id"],
                "email"=> $email,
                "name"=> $user->name,
                "telephone"=> $user->telephone,
                "status_app"=> '1',
            ]);

            //форматирование даты
            $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s.u', $application_create->date)->format('d.m.Y H:i');

            $message = 'Вы получили это сообщение, так как оставляли заявку на бронирование в ретсоране SUNRISE.
            ФИО: ' . $name . ',
            Дата: ' . $formattedDate . ',
            Интервал посещения: ' . $applicationInfo['time_interval'] . ',
            Номер стола: ' . $applicationInfo["table_id"] . ',
            Количество человек ' . $applicationInfo["people"] . ',
            Следить за статусом бронирования: http://sunrise/personal';

            if ($application_create) {
                mail($email, 'Бронирование SUNRISE', $message);
                return back()->with("success","Вы забронировали стол! При желании добавьте предзаказ блюд в ваш заказ через личный кабинет.");

            }
        }

    }

    public function guest_application_create(Request $request) {
        // Получаем текущее время
        $currentTime = (new DateTime('now', new DateTimeZone('Asia/Yekaterinburg')))->format('H:i:s');

        $applicationInfo = $request->validate([
            "date"=> "required|date|after_or_equal:today",
            "time"=> "required",
            "time_interval"=> "required",
            "people"=> "required",
            "email"=> "required|email",
            "name"=> "required",
            "telephone"=> "required|min:11",
            "table_id"=>"required"

        ],
            [
                "date.required" => "Поле обязательно для заполнения!",
                "date.after_or_equal" => "Нельзя записаться на прошлые даты!",
                "time.required" => "Поле обязательно для заполнения!",

                "time_interval.required" => "Поле обязательно для заполнения!",

                "telephone.required" => "Поле обязательно для заполнения!",
                "telephone.min" => "Минимальное количество символов - 11",

                "people.required" => "Поле обязательно для заполнения!",
                "table_id.required" => "Поле обязательно для заполнения!",

                "name.required" => "Поле обязательно для заполнения!",

                "email.required" => "Поле обязательно для заполнения!",
                "email.email" => "Введите корректный email",
            ]);

        $selectedDate = $applicationInfo['date'];
        $selectedTime = $applicationInfo['time'];
        $timeInterval = $applicationInfo['time_interval'];
        $closingTime = '24:00:00.0000';

        $selectedDateTime = Carbon::createFromFormat('Y-m-d H:i:s.u', $selectedDate . ' ' . $selectedTime);
        $endDateTime = $selectedDateTime->copy()->addHours($timeInterval)->addMinutes($timeInterval * 60 % 60);

        $today = date('Y-m-d');

        if ($selectedDate == $today) {
            // Если выбранная дата - сегодняшняя дата, проверяем время

            if ($selectedTime < $currentTime) {
                // Если выбранное время меньше текущего времени, возвращаем ошибку валидации
                return back()->withErrors(['time' => 'Нельзя выбрать время, которое уже прошло.']);
            }
        }
        if ($endDateTime->format('H:i:s') > $closingTime) {
            return back()->withErrors(['time_interval' => 'Выбранный интервал посещения выходит за пределы времени закрытия ресторана.']);
        }


        $table = $applicationInfo['table_id'];
        $tableRow = Table::find($table);

        $people = $applicationInfo['people'];

        if($tableRow->max_people < $people) {
            return back()->withErrors(['people' => 'Недопустимое количество человек для данного стола. Допустимое - ' . $tableRow->max_people . '.']);
        }

        $date = $applicationInfo['date'] . ' ' . $applicationInfo['time'];

        $existingBooking = Application::where('table_id', $applicationInfo['table_id'])
            ->where('date',  $date)
            ->where('time_interval', $applicationInfo['time_interval'])->where('status_app', '!=', '3')
            ->first();

        if ($existingBooking) {
            // Если бронь уже существует, выводим сообщение об ошибке
            return back()->with('error', 'Данный стол уже забронирован в выбранное время.');
        } else {

            $application_create= Application::create([
                "date"=>  $date,
                "time_interval"=> $applicationInfo["time_interval"],
                "people"=> $applicationInfo["people"],
                "table_id"=> $applicationInfo["table_id"],
                "email"=> $applicationInfo['email'],
                "name"=> $applicationInfo['name'],
                "telephone"=> $applicationInfo['telephone'],
                "status_app"=> '1',
            ]);

            //форматирование даты
            $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s.u', $application_create->date)->format('d.m.Y H:i');


            $name = $applicationInfo['name'];
            $email = $applicationInfo['email'];
            $message = 'Вы получили это сообщение, так как оставляли заявку на бронирование в ретсоране SUNRISE.
            Имя: ' . $name . ',
            Номер телефона: ' . $applicationInfo['telephone'] . ',
                Дата: ' . $formattedDate . ',
            Интервал посещения: ' . $applicationInfo['time_interval'] . ',
            Номер стола: ' . $applicationInfo["table_id"] . ',
            Количество человек ' . $applicationInfo["people"] . ',
            Следить за статусом бронирования: http://sunrise/personal';

            if ($application_create) {
                mail($email, 'Бронирование SUNRISE', $message);
                return back()->with("success","Вы забронировали стол! При желании добавьте предзаказ блюд в ваш заказ через личный кабинет.");

            }
        }

    }

    public function personal_application($id) {
        $application = Application::find($id);
        $userId = Auth::user()->id;

//        $user = User::find($userId);
        $applications = Application::where('email', Auth::user()->email)->with('statusApp')->orderBy('created_at', 'desc')->paginate(5);

        $date = Carbon::createFromFormat('Y-m-d H:i:s.u', $application->date)
            ->format('d.m.Y H:i');

        $application->formatted_date = $date;

        $typeMenu = TypeMenu::find(10);
        $typesMenu = TypeMenu::all();

        $dishes = $typeMenu->dishes->groupBy('type_dishes');

        $typeDishes = TypeDish::whereIn('id', $dishes->keys())->get();

        return view("personal_application", [
            'application' => $application,
            'dishes' => $dishes,
            'typeMenu' => $typeMenu,
            'typesMenu' => $typesMenu,
            'typeDishes' => $typeDishes,
        ]);
    }

    public function app_dish_add(Request $request, $id)
    {
        $request->validate([
            "count" => "required|min:1",
        ], [
            "count.required" => "Поле обязательно для заполнения!",
            "count.min" => "Минимальное количество блюд - 1!",
        ]);

        $orderInfo = $request->all();

        $appIdInfo = $orderInfo['app_id'];
        $appId = Application::find($appIdInfo);

        $orderCreate = ApplicationMenu::create([
            "app_id" => $orderInfo['app_id'],
            "dish_id" => $id,
            "count" => $orderInfo['count'],
        ]);

        if($orderCreate) {
            return redirect()->back()->with('success', 'Блюдо добавлено в заказ.');
        } else {
            return redirect()->back()->with('error', 'Не вышло добавить блюдо.');
        }


    }
}
