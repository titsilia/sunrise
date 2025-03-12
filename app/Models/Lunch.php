<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lunch extends Model
{
    protected $fillable = [
        'id',
        'id_dish_l',
        'dish_id',
    ];

    public function mainDish()
    {
        return $this->belongsTo(Dish::class, 'id_dish_l', 'id');
    }

    public function dish()
    {
        return $this->hasOne(Dish::class, 'id', 'dish_id');
    }

}


