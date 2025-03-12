<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth() {
        return view("auth");
    }


    public function auth_user(Request $request) {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ], [
            "email.required" => "Поле обязательно для заполнения!",
            "email.email" => "Введите корректный email",
            "password.required" => "Поле обязательно для заполнения!",
        ]);

        $user = $request->only("email", "password");
        if (Auth::attempt([
           "email" => $user["email"],
           "password" => $user["password"]
       ])) {
        return redirect("/personal")->with("success","");
       } else {
       return redirect()->back()->with("error","Неверный логин или пароль");
       }

    }

    public function reg() {
        return view("reg");
    }

    public function reg_user(Request $request) {
        $request->validate([
            "email"=> "required|unique:users|email",
            "name"=> "required",
            "surname"=> "required",
            "patronymic"=> "required",
            "telephone"=> "required|min:11",
            "password"=> "required|min:6",
            "confirm_password"=>"required|same:password"
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

                "password.required" => "Поле обязательно для заполнения!",
                "password.min" => "Минимальное количество символов - 6",

                "confirm_password.required" => "Поле обязательно для заполнения!",
                "confirm_password.min" => "Минимальное количество символов - 6",
                "confirm_password.same" => "Пароли не совпадают",
        ]);


        $userInfo=$request->all();

        $user_create= User::create([
            "email"=> $userInfo["email"],
            "name"=> $userInfo["name"],
            "surname"=> $userInfo["surname"],
            "patronymic"=> $userInfo["patronymic"],
            "telephone"=> $userInfo["telephone"],
            "role_id"=> '2',
            "password"=> Hash::make($userInfo["password"]),
        ]);

        if ($user_create) {
            return redirect("/auth")->with("success","Вы успешно зарегистрировались! Теперь войдите");

        } else {
            return redirect()->back()->with("error","Произошла ошибка! Попробуйте снова!");
        }

    }

    public function exit() {
        Session::flush();
        Auth::logout();
        return redirect("/");
    }
}
