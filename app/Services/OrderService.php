<?php

namespace App\Services;

use App\Enums\ReservationStatus;
use App\Repositories\OrderRepository;
use App\Models\Meal;

class OrderService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function makeOrder(array $data)
    {
        $meals = $this->calculatePayByMeal($data['meals']);
        $data['total'] = array_sum($meals);
        $order =$this->orderRepository->storeOrder($data);
        $this->orderRepository->storeOrderDetails($order, $meals);
    }

    private function calculatePayByMeal($meals) :array
    {
        $result= [];
        foreach ($meals as $meal_id) {
            $meal = Meal::find($meal_id);
            if ($meal->discount) {
                $result[$meal_id]= $this->calculatePrice($meal->price, $meal->discount);
            }
        }
        return $result;
    }

    public function calculatePrice(float $price, int $discount)
    {
        return ceil($price - ($price * ($discount / 100)));
    }

    public function checkout($order_id)
    {
       return $this->orderRepository->updateReservationOrderStatus($order_id, ReservationStatus::CHECKOUT);
    }
}
