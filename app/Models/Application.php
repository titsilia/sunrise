<?php

namespace App\Models;
use App\Models\User;
use App\Models\Application;
use App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'id',
        'people',
        'date',
        'time_interval',
        'name',
        'email',
        'table_id',
        'telephone',
        'status_app',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusApp()
    {
        return $this->belongsTo(Status::class, 'status_app');
    }
}
