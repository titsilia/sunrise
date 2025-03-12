<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Carbon\Carbon;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    public function personal() {
        $userId = Auth::user()->id;

        $applications = Application::where('email', Auth::user()->email)->with('statusApp')->orderBy('created_at', 'desc')->paginate(5);

        $formattedApplications = $applications->map(function ($application) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s.u', $application->date)
                        ->format('d.m.Y H:i');

            $application->formatted_date = $date;

            return $application;
        });

        return view("personal", [
            'applications' => $applications,
        ]);
    }

    public function personal_update(Request $request) {
        $request->validate([
            "email"=> "required|email",
            "name"=> "required",
            "surname"=> "required",
            "patronymic"=> "required",
            "telephone"=> "required|min:11",
            ],
            [
                "name.required" => "Поле обязательно для заполнения!",
                "surname.required" => "Поле обязательно для заполнения!",
                "patronymic.required" => "Поле обязательно для заполнения!",

                "telephone.required" => "Поле обязательно для заполнения!",
                "telephone.min" => "Минимальное количество символов - 11",

                "email.required" => "Поле обязательно для заполнения!",
                "email.email" => "Введите корректный email",
                "email.unique" => "Данный email уже занят",

        ]);

        $user = Auth::user();

        $userInfo = $request->all();
        $userInfo["password"] = $user->password;

        $user_update = $user->update($userInfo);

        if($user_update) {
            return redirect("/personal")->with('success', 'Профиль успешно обновлен.');
        } else {
            return redirect("/personal")->with('error', 'Не вышло обновить профиль.');
        }


    }

}
