<?php

namespace App\Http\Resources;

use App\Services\OrderService;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data=[];
        foreach ($this->resource->details as $item) {
            $data[]=[
                'price'=> $item->meal->price,
                'discount' => $item->meal->discount. '%',
                'price_after_discount'=> app(OrderService::class)->calculatePrice($item->meal->price, $item->meal->discount)
            ];
        }
     
        return [
            'items'=>  $data,
            'total_price'=> array_sum(array_column($data, 'price_after_discount'))
        ];
    }
}
