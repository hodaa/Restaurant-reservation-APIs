<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' =>$this->faker->randomFloat(2, 0, 400),
            'description' => $this->faker->text(),
            'quantity_available'=> $this->faker->numberBetween(0,10),
            'discount' =>$this->faker->numberBetween(10,50),

        ];
    }
}
