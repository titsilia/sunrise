<?php

namespace App\Models;
use App\Models\User;
use App\Models\Application;
use App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationMenu extends Model
{
    protected $fillable = [
        'id',
        'app_id',
        'dish_id',
        'count',
    ];

    public function dish()
    {
        return $this->hasOne(Dish::class, 'id', 'dish_id');
    }

    public function application()
    {
        return $this->hasOne(Application::class, 'id', 'app_id');
    }
}
