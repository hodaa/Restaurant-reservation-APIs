<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderDetails;

class OrderRepository
{
    public function storeOrder(array $data)
    {
        $data['date'] = Carbon::now();
        $order = new Order();
        $order->fill($data);
        $order->save();
        return $order;
    }

    public function storeOrderDetails($order, $meals)
    {
        foreach ($meals as $meal_id=>$price) {
            $detail = new OrderDetails();
            $detail->meal_id = $meal_id;
            $detail->amount_to_pay = $price;
            $order->details()->save($detail);
        }
    }
    
    public function updateReservationOrderStatus(int $order_id, $status)
    {
        $order= Order::find($order_id);
        $order->reservation->update(['status'=>$status]);
        return $order;
    }

    public function getOrderDetails(int $order_id)
    {
        return Order::find($order_id)->details;
    }
}
