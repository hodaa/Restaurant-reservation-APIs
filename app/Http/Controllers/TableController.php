<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeOrderRequest;
use Illuminate\Http\Request;
use App\Services\ReservationService;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\InvoiceResource;
use App\Services\OrderService;
use App\Http\Requests\CheckAvailability;

use Exception;


class TableController extends Controller
{
    private ReservationService $reservationService;


    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService =  $reservationService;
    }

  
    public function checkAvailability(CheckAvailability $request)
    {
        return $this->reservationService->getAvailableTables($request->capacity, $request->form_time, $request->to_time);
    }


    public function reserve(ReservationRequest $request)
    {
        $reservationData =(object) $request->input();
        $table_id = $this->reservationService->reserve($reservationData);
        return $table_id ? response(["message" => "Table  $table_id is booked for you"]) : response(["message" => "You are in waiting list"]);
    }
    
    public function order(MakeOrderRequest $request)
    {
        try {
            $data = $request->input();
            $data['table_id'] = $request->id;
            $order = app(OrderService::class)->makeOrder($data);
            return response(['message'=>"Your order is being prepared"]);
        } catch(Exception $e){
            return response(['error'=> "This table has no  reservation"]);
        }
    }

    public function checkout(Request $request)
    {
        $order = app(OrderService::class)->checkout($request->order_id);
        return response([
            'message'=> 'This is your invoice',
            'data' => new InvoiceResource($order),
        ]);
    }
}
