<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function places()
    {
        return $this->belongsToMany(Place::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
