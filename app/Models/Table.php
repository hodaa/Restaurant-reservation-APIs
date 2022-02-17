<?php

namespace App\Models;

use App\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    public  function Reservations()
    {
       return $this->hasMany(\App\Models\Reservation::class);
    }

    public function scopeActive($query)
    {
        $query->where('status', ReservationStatus::CONFIRMED);
    }
}


