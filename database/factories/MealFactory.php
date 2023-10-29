<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    protected $model = Meal::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $availableQuantity = $this->faker->numberBetween(1, 100);
        $initialQuantity = $this->faker->numberBetween($availableQuantity + 1, 200); // Adjust the maximum value as needed

        return [
            'price' => $this->faker->randomFloat(2, 5, 50),
            'description' => $this->faker->sentence(6),
            'available_quantity' => $availableQuantity,
            'initial_quantity' => $initialQuantity,
            'discount' => $this->faker->randomFloat(2, 0, 10),
        ];
    }
}
