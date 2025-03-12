<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'id',
        'dish_name',
        'dish_desc',
        'cost',
        'weight',
        'type_dishes',
    ];

    public function typeMenus()
    {
        return $this->belongsToMany(TypeMenu::class, 'menu_type_dishes', 'dish_id', 'type_id');
    }

    public function typeDish()
    {
        return $this->belongsTo(TypeDish::class, 'type_dishes');
    }

    public function lunches()
    {
        return $this->hasMany(Lunch::class, 'id_dish_l', 'id');
    }
}


