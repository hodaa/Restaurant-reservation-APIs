<?php

namespace App\Repositories;
use App\Models\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Reservation;
use App\Enums\ReservationStatus;
use Carbon\Carbon;

class ReservationRepository
{

    public function buildTableAvailableQuery($start_time, $to_time)
    {
        
        return Table::whereDoesntHave('reservations', function (Builder $q) use ($start_time, $to_time) {
            $q->where(function($query)  use ($start_time, $to_time){
                
                $start_time_extra = Carbon::parse($start_time)->addMinute(1)->toTimeString();
                $to_time_minus = Carbon::parse($to_time)->subMinute(1)->toTimeString();

                $query->whereBetween('reservations.from_time', [$start_time,$to_time_minus]);
                $query->orWhereBetween('reservations.to_time', [$start_time_extra,$to_time]);
                $query->where('reservations.status', '!=', ReservationStatus::CHECKOUT);
             });

            
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