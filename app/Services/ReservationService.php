<?php

namespace App\Services;
use App\Enums\ReservationStatus;
use App\Repositories\ReservationRepository;

class ReservationService
{
    private $reservationRepository;
    
    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }


    public function getAvailableTables($capacity, $start_time, $end_time)
    {
        return $this->reservationRepository->buildTableAvailableQuery($start_time, $end_time)->where('tables.capacity', '>=', $capacity)->groupBy('tables.id')->get();
    }

    public function checkTableAvailable($table_id, $start_time, $end_time)
    {
        return $this->reservationRepository->buildTableAvailableQuery($start_time, $end_time)($start_time, $end_time)->where('id', $table_id)->count();
        
    }

    public function reserve($reservationData)
    {
        
        $tables = $this->getAvailableTables($reservationData->capacity, $reservationData->from_time, $reservationData->to_time);
        $status = ReservationStatus::WAITING_LIST;
        if (count($tables)) {
           $reservationData->table_id = $tableId = $tables->first()->id;
           $status = ReservationStatus::CONFIRMED;
        }

        
        $this->reservationRepository->createReservation($reservationData,$status);
        return $tableId ?? null;
    }
}
