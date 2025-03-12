<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTypeDishes extends Model
{
    protected $fillable = [
        'id',
        'type_id',
        'dish_id',
    ];
}
