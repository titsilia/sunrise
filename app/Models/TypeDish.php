<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDish extends Model
{
    protected $fillable = [
        'id',
        'dishes_type',
    ];
}
