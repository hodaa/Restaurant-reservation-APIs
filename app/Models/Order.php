<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;

     protected $fillable= ['table_id','customer_id','reservation_id','waiter_id','total','paid','date'];

     public function details()
     {
         return $this->hasMany(OrderDetails::class);
     }

     public function reservation(){

        return $this->belongsTo(Reservation::class);
     }
}
