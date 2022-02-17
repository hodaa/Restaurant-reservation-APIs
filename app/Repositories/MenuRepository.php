<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Meal;


class MenuRepository
{
    public function getAvailableMeals()
    {
        return Meal::where('quantity_available','!=',0)->get();
    }
    
}