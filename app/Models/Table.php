<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    public  function Reservations()
    {
       return $this->hasMany(\App\Models\Reservation::class);
    }
}


