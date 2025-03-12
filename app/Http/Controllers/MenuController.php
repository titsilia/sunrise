<?php

namespace App\Http\Controllers;

use App\Models\Lunch;
use Illuminate\Http\Request;

use App\Models\Dish;
use App\Models\TypeDish;
use App\Models\TypeMenu;
use App\Models\MenuTypeDishes;

class MenuController extends Controller
{
    public function menu($id) {

        $typeMenu = TypeMenu::find($id);
        $typesMenu = TypeMenu::all();

        $dishes = $typeMenu->dishes->groupBy('type_dishes');

        $typeDishes = TypeDish::whereIn('id', $dishes->keys())->get();


        return view("menu", [
            'dishes' => $dishes,
            'typeMenu' => $typeMenu,
            'typesMenu' => $typesMenu,
            'typeDishes' => $typeDishes,
        ]);
    }

    public function menu_lunch() {

        $typeMenu = TypeMenu::find(16);
        $typesMenu = TypeMenu::all();

        $lunches = $typeMenu->dishes->groupBy('type_dishes');

        $typeDishes = TypeDish::whereIn('id', $lunches->keys())->get();

        $lunches = Lunch::with('mainDish', 'dish')->get()->groupBy('id_dish_l');

        return view("menu_lunches", [
            'lunches' => $lunches,
            'typeMenu' => $typeMenu,
            'typesMenu' => $typesMenu,
            'typeDishes' => $typeDishes,
        ]);
    }
}
