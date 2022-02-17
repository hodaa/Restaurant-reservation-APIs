<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealResource;
use App\Repositories\MenuRepository;

class MenuController extends Controller
{
    private MenuRepository $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository= $menuRepository;
    }
    public function listMeals()
    {
        $meals = $this->menuRepository->getAvailableMeals();
        return  MealResource::collection($meals);
    }
}
