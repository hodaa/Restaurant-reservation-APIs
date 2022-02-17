<?php

namespace App\Repositories;
use App\Models\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Reservation;
use App\Enums\ReservationStatus;

class ReservationRepository
{

    public function buildTableAvailableQuery($start_time, $to_time)
    {
        return Table::whereDoesntHave('reservations', function (Builder $query) use ($start_time, $to_time) {
            $query->where('reservations.from_time', '<=', $start_time);
            $query->where('reservations.from_time', '<=', $to_time);
            $query->where('reservations.to_time', '>=', $start_time);
            $query->where('reservations.to_time', '>=', $to_time);

            $query->where('reservations.status', '!=', ReservationStatus::CHECKOUT);
        })->select('tables.id', 'tables.capacity');
    }

    public function createReservation($data, int $status = ReservationStatus::CONFIRMED){
        
        return  Reservation::create([
            'table_id'=> $data->table_id ?? null,
            'customer_id' => $data->customer_id,
            'capacity' => $data->capacity,
            'from_time'=> $data->from_time,
            'to_time'=> $data->to_time,
            'status' => $status
        ]);
    }
    
  

}