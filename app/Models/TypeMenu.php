<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMenu extends Model
{
    protected $fillable = [
        'id',
        'menu_type',
        'time_type',
    ];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'menu_type_dishes', 'type_id', 'dish_id');
    }

}

