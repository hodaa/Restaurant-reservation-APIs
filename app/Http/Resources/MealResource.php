<?php

namespace App\Http\Resources;

use App\Services\OrderService;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'description'=> $this->description,
            'price'=> $this->price,
            'discount' => $this->discount,
            'price_after_discount'=> app(OrderService::class)->calculatePrice($this->price,$this->discount)
        ];
    }
}
