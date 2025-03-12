<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;


\Carbon\Carbon::setLocale('ru');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Application;
use App\Models\Status;
use App\Models\Dish;
use App\Models\Lunch;
use App\Models\TypeDish;
use App\Models\TypeMenu;
use App\Models\MenuTypeDishes;


class AdminController extends Controller
{

    //Заявки
    public function admin_applications(Request $request)
    {
        $statusOrder = $request->input('status', 1);

        $applications = Application::with('user')->with('statusApp')->where('status_app', $statusOrder)->orderBy('created_at', 'asc')->paginate(4);

        $formattedApplications = $applications->map(function ($application) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s.u', $application->date)->format('d.m.Y');
            $dayOfWeek = Carbon::createFromFormat('Y-m-d H:i:s.u', $application->date)->isoFormat('dddd');
            $locale = Carbon::getLocale();
            if ($locale == 'ru') {
                $dayOfWeek = mb_convert_case($dayOfWeek, MB_CASE_TITLE, "UTF-8");
            } else {
                $dayOfWeek = ucfirst($dayOfWeek);
            }
            $application->formatted_date = $date;
            $application->day_of_week = $dayOfWeek;
            $application->formatted_time = Carbon::createFromFormat('Y-m-d H:i:s.u', $application->date)->format('H:i');

            return $application;
        });

        $groupedApplications = $formattedApplications->groupBy(function ($application) {
            return $application->formatted_date;
        });

        return view("admin.applications", [
            'groupedApplications' => $groupedApplications,
        ]);
    }

    public function confirm($id)
    {

        $application = DB::table('applications')->where('id',"=",$id)->update(['status_app' => 2]);

        return redirect()->back();
    }

    public function deny($id)
    {

        $application = DB::table('applications')->where('id',"=",$id)->update(['status_app' => 3]);

        return redirect()->back();
    }


    // РЕНДЕР СТРАНИЦ
    public function admin_control() {
        return view("admin.control");
    }

//new
    public function admin_edit_types_menu() {
        $typeMenus = TypeMenu::all();

        return view("admin.edit_types_menu", [
            'typeMenus' => $typeMenus,
            'TypeMenu' => TypeMenu::first(),
        ]);
    }

    public function admin_edit_types_dishes() {
        $typeDishes = TypeDish::all();

        return view("admin.edit_types_dishes", [
            'typeDishes' => $typeDishes,
            'TypeDish' => TypeDish::first(),
        ]);
    }

    public function admin_edit_dishes() {
        $Dishes = Dish::with('typeDish')->whereDoesntHave('lunches')->get();
        $typeDishes = TypeDish::all();
        $typeMenus = TypeMenu::all();
        $typeDishesAll = TypeDish::all();
        $Dish = Dish::first();
        $DishTypesMenuIds = MenuTypeDishes::where('dish_id', $Dish->id)->pluck('type_id')->toArray();

        return view("admin.edit_dishes", [
            'Dishes' => $Dishes,
            'Dish' => $Dish,
            'typeDishes' => $typeDishes,
            'typeMenus' => $typeMenus,
            'typeDishesAll' => $typeDishesAll,
            'DishTypesMenuIds' => $DishTypesMenuIds,
        ]);
    }

    public function admin_edit_lunches() {
        $Lunches = Dish::with('typeDish')->whereHas('lunches')->get();
        $Dishes = Dish::with('typeDish')->whereDoesntHave('lunches')->get();
        $typeDishes = TypeDish::all();
        $typeMenus = TypeMenu::all();
        $typeDishesAll = TypeDish::all();
        $Lunch = Dish::whereHas('lunches')->firstOrFail();
        $currentLunchDishIds = Lunch::where('id_dish_l', $Lunch->id)->pluck('dish_id')->toArray();

        $LunchDishes = Dish::with('typeDish')->whereIn('id', $currentLunchDishIds)->get();

        $DishTypesMenuIds = MenuTypeDishes::where('dish_id', $Lunch->id)->pluck('type_id')->toArray();

        return view("admin.edit_lunches", [
            'Lunches' => $Lunches,
            'Dishes' => $Dishes,
            'Lunch' => $Lunch,
            'typeDishes' => $typeDishes,
            'typeMenus' => $typeMenus,
            'typeDishesAll' => $typeDishesAll,
            'LunchDishesView' => $Dishes,
            'LunchDishes' => $LunchDishes,
            'DishTypesMenuIds' => $DishTypesMenuIds,
        ]);
    }


    // ДОБАВЛЕНИЕ
    public function type_dish_create(Request $request) {
        $request->validate([
            "dishes_type"=> "required",
            ],
            [
                "dishes_type.required" => "Поле обязательно для заполнения!",
        ]);


        $typeDishInfo=$request->all();

        $typeDish_create= TypeDish::create([
            "dishes_type"=> $typeDishInfo["dishes_type"],
        ]);

        if ($typeDish_create) {
            return redirect()->back()->with("success1","Всё получилось");

        } else {
            return redirect()->back()->with("error1","Произошла ошибка! Попробуйте снова!");
        }

    }

    public function type_menu_create(Request $request) {
        $request->validate([
            "menu_type"=> "required",
            "time_type"=> "required",
            ],
            [
                "menu_type.required" => "Поле обязательно для заполнения!",
                "time_type.required" => "Поле обязательно для заполнения!",
        ]);


        $typeMenuInfo=$request->all();

        $typeMenu_create = TypeMenu::create([
            "menu_type"=> $typeMenuInfo["menu_type"],
            "time_type"=> $typeMenuInfo["time_type"],
        ]);

        if ($typeMenu_create) {
            return redirect()->back()->with("success1","Всё получилось");

        } else {
            return redirect()->back()->with("error1","Произошла ошибка! Попробуйте снова!");
        }

    }

    public function dish_create(Request $request) {
        $request->validate([
            "dish_name"=> "required",
            "dish_desc"=> "required",
            "cost"=> "required|numeric|min:0",
            "type_dishes"=> "required",
            "weight"=> "required|numeric|min:0",
            "type_menus"=> "required",
            ],
            [
                "dish_name.required" => "Поле обязательно для заполнения!",
                "dish_desc.required" => "Поле обязательно для заполнения!",
                "weight.required" => "Поле обязательно для заполнения!",
                "weight.numeric" => "Только числовое значение!",
                "weight.min" => "Значение должно быть положительным числом или нулем.",

                "cost.required" => "Поле обязательно для заполнения!",
                "cost.numeric" => "Только числовое значение!",
                "cost.min" => "Значение должно быть положительным числом или нулем.",
                "type_dishes.required" => "Поле обязательно для заполнения!",
                "type_menus.required" => "Поле обязательно для заполнения!",
        ]);


        $dishInfo=$request->all();

            $dish_create = Dish::create([
                "dish_name"=> $dishInfo["dish_name"],
                "dish_desc"=> $dishInfo["dish_desc"],
                "cost"=> $dishInfo["cost"],
                "weight"=> $dishInfo["weight"],
                "type_dishes"=> $dishInfo["type_dishes"],
            ]);

            array_push($dishInfo['type_menus'], 10);

            $dishId = $dish_create->id;

            foreach($dishInfo['type_menus'] as $typeMenu) {
                $connection_create = MenuTypeDishes::create([
                    "dish_id"=> $dishId,
                    "type_id"=> $typeMenu,
                ]);
            }


        if ($connection_create) {
            return redirect()->back()->with("success1","Всё получилось");

        } else {
            return redirect()->back()->with("error1","Произошла ошибка! Попробуйте снова!");
        }

    }

    public function lunch_create(Request $request) {
        $request->validate([
            "dish_name"=> "required",
            "cost"=> "required|numeric|min:0",
            'dishes'=> "required",
        ],
            [
                "dish_name.required" => "Поле обязательно для заполнения!",
                "dishes.required" => "Поле обязательно для заполнения!",
                "cost.required" => "Поле обязательно для заполнения!",
                "cost.numeric" => "Только числовое значение!",
                "cost.min" => "Значение должно быть положительным числом или нулем.",
            ]);


        $dishInfo=$request->all();

        $dish_create = Dish::create([
            "dish_name"=> $dishInfo["dish_name"],
            "dish_desc"=> 'Комбо',
            "cost"=> $dishInfo["cost"],
            'weight' => '1',
            "type_dishes"=> 12,
        ]);

        $typeMenus = [16, 10];

        $dishId = $dish_create->id;

        foreach($typeMenus as $typeMenu) {
            $connection_create = MenuTypeDishes::create([
                "dish_id"=> $dishId,
                "type_id"=> $typeMenu,
            ]);
        }

        foreach($dishInfo['dishes'] as $dish) {
            $connection_create = Lunch::create([
                "id_dish_l"=> $dishId,
                "dish_id"=> $dish,
            ]);
        }

        if ($connection_create) {
            return redirect()->back()->with("success1","Всё получилось");

        } else {
            return redirect()->back()->with("error1","Произошла ошибка! Попробуйте снова!");
        }

    }


    // РЕДАКТИРОВАНИЕ
    public function type_menu_update(Request $request, $id) {
        $request->validate([
            "edit_menu_type"=> "required",
            "edit_time_type"=> "required",
            ],
            [
                "edit_menu_type.required" => "Поле обязательно для заполнения!",
                "edit_time_type.required" => "Поле обязательно для заполнения!",
        ]);


        $typeMenuInfo=$request->all();

        $typeMenu = TypeMenu::find($id);

        $typeMenu->menu_type = $typeMenuInfo['edit_menu_type'];
        $typeMenu->time_type = $typeMenuInfo['edit_time_type'];

        $typeMenu->save();

        return  redirect()->back()->with('success2', 'Категория успешно обновлена.');
    }

    public function updateFormTypeMenu(Request $request)
    {
        $id_type_menu = $request->input('id_type_menu');
        $TypeMenu = TypeMenu::find($id_type_menu);

        return view('admin.edit_types_menu', [
            'typeMenus' => TypeMenu::all(),
            'TypeMenu' => $TypeMenu,
        ]);
    }

    public function type_dish_update(Request $request, $id) {
        $request->validate([
            "edit_dishes_type"=> "required",
            ],
            [
                "edit_dishes_type.required" => "Поле обязательно для заполнения!",
        ]);


        $typeDishInfo=$request->all();

        $typeDish = TypeDish::find($id);

        $typeDish->dishes_type = $request['edit_dishes_type'];

        $typeDish->save();

        return  redirect()->back()->with('success2', 'Категория успешно обновлена.');
    }

    public function updateFormTypeDish(Request $request)
    {
        $id_type_dish = $request->input('id_type_dish');
        $TypeDish = TypeDish::find($id_type_dish);

        return view('admin.edit_types_dishes', [
            'typeDishes' => TypeDish::all(),
            'TypeDish' => $TypeDish,
        ]);
    }

    public function dish_update(Request $request, $id) {
        $request->validate([
            "edit_dish_name"=> "required",
            "edit_dish_desc"=> "required",
            "edit_cost"=> "required|numeric|min:0",
            "edit_weight"=> "required|numeric|min:0",
            "edit_type_dishes"=> "required",
            ],
            [
                "edit_dish_name.required" => "Поле обязательно для заполнения!",
                "edit_dish_desc.required" => "Поле обязательно для заполнения!",
                "edit_weight.required" => "Поле обязательно для заполнения!",
                "edit_weight.numeric" => "Только числовое значение!",
                "edit_weight.min" => "Значение должно быть положительным числом или нулем.",
                "edit_cost.required" => "Поле обязательно для заполнения!",
                "edit_cost.numeric" => "Только числовое значение!",
                "edit_cost.min" => "Значение должно быть положительным числом или нулем.",
                "edit_type_dishes.required" => "Поле обязательно для заполнения!",
        ]);


        $dishInfo=$request->all();

        $dish = Dish::find($id);

        $dish->dish_name = $dishInfo['edit_dish_name'];
        $dish->dish_desc = $dishInfo['edit_dish_desc'];
        $dish->cost = $dishInfo['edit_cost'];
        $dish->type_dishes = $dishInfo['edit_type_dishes'];

        $dish->save();

        return  redirect()->back()->with('success2', 'Блюдо успешно обновлено.');
    }

    public function updateFormDish(Request $request)
    {
        $id_dish = $request->input('id_dish');
        $Dish = Dish::find($id_dish);
        $typeDishes = TypeDish::all();
        $typeMenus = TypeMenu::all();
        $typeDishesAll = TypeDish::all();
        $DishTypesMenuIds = MenuTypeDishes::where('dish_id', $Dish->id)->pluck('type_id')->toArray();

        return view('admin.edit_dishes', [
            'Dishes' => Dish::with('typeDish')->whereDoesntHave('lunches')->get(),
            'Dish' => $Dish,
            'typeDishes' => $typeDishes,
            'typeMenus' => $typeMenus,
            'typeDishesAll' => $typeDishesAll,
            'DishTypesMenuIds' => $DishTypesMenuIds,
        ]);
    }

    public function lunch_update(Request $request, $id) {
        $request->validate([
            "edit_dish_name"=> "required",
            "edit_cost"=> "required|numeric|min:0",
            'edit_dishes'=> "required",
            'edit_type_menus'=> "required",
        ],
            [
                "dish_name.required" => "Поле обязательно для заполнения!",
                "edit_type_menus.required" => "Поле обязательно для заполнения!",
                "dishes.required" => "Поле обязательно для заполнения!",
                "cost.required" => "Поле обязательно для заполнения!",
                "cost.numeric" => "Только числовое значение!",
                "cost.min" => "Значение должно быть положительным числом или нулем.",
            ]);


        $dishInfo=$request->all();

        $dish = Dish::find($id);

        $dish->dish_name = $dishInfo['edit_dish_name'];
        $dish->cost = $dishInfo['edit_cost'];
        $dish->save();

        Lunch::where('id_dish_l', $id)->delete();

        foreach($dishInfo['edit_dishes'] as $dish) {
            $connection_create = Lunch::create([
                "id_dish_l"=> $id,
                "dish_id"=> $dish,
            ]);
        }

        MenuTypeDishes::where('dish_id', $id)->delete();

        array_push($dishInfo['edit_type_menus'], 10);

        foreach($dishInfo['edit_type_menus'] as $typeMenu) {
            $connection_create = MenuTypeDishes::create([
                "dish_id"=> $id,
                "type_id"=> $typeMenu,
            ]);
        }

        if($connection_create) {
            return redirect()->back()->with('success2', 'Комбо успешно обновлено.');
        } else {
            return redirect()->back()->with("error1","Произошла ошибка! Попробуйте снова!");
        }

    }

    public function updateFormLunch(Request $request)
    {
        $id_dish = $request->input('id_dish');
        $Dishes = Dish::with('typeDish')->whereDoesntHave('lunches')->get();
        $Lunch = Dish::find($id_dish);
        $typeMenus = TypeMenu::all();
        $Lunches = Dish::with('typeDish')->whereHas('lunches')->get();
        $currentLunchDishIds = Lunch::where('id_dish_l', $id_dish)->pluck('dish_id')->toArray();
        $LunchDishes = Dish::with('typeDish')->whereIn('id', $currentLunchDishIds)->get();

        $DishTypesMenuIds = MenuTypeDishes::where('dish_id', $id_dish)->pluck('type_id')->toArray();

        return view('admin.edit_lunches', [
            'Lunches' => $Lunches,
            'LunchDishesView' => $Dishes,
            'LunchDishes' => $LunchDishes,
            'Dishes' => $Dishes,
            'Lunch' => $Lunch,
            'DishTypesMenuIds' => $DishTypesMenuIds,
            'typeMenus' => $typeMenus,
        ]);
    }


    // УДАЛЕНИЕ
    public function type_menu_delete($id) {
        $typeMenu = TypeMenu::find($id);

        $menuTypeDishes = MenuTypeDishes::where('type_id',"=", $id);

        $menuTypeDishes->delete();
        $typeMenu->delete();


        return  redirect()->back()->with('success', 'Категория успешно удалкна.');
    }

    public function type_dish_delete($id) {
        $typeDish = TypeDish::find($id);

        $dishes = Dish::where('type_dishes',"=", $id);

        $dishes->delete();
        $typeDish->delete();


        return  redirect()->back()->with('success', 'Категория успешно удалена.');
    }

    public function dish_delete($id) {
        $dish = Dish::find($id);

        $menuTypeDishes = MenuTypeDishes::where('dish_id',"=", $id);

        $menuTypeDishes->delete();
        $dish->delete();


        return  redirect()->back()->with('success', 'Блюдо успешно удалено.');
    }

    public function lunch_delete($id) {
        $dish = Dish::find($id);

        $menuTypeDishes = MenuTypeDishes::where('dish_id',"=", $id);
        $Lunch = Lunch::where('id_dish_l', $id);

        $menuTypeDishes->delete();
        $Lunch->delete();
        $dish->delete();


        return  redirect()->back()->with('success', 'комбо успешно удалено.');
    }
}
