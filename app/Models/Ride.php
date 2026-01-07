<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = ['pickup', 'dropoff', 'time', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
