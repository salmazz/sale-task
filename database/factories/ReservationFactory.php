<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_id' => function () {
                return Table::factory()->create()->id;
            },
            'customer_id' => function () {
                return Customer::factory()->create()->id;
            },
            'from_time' => $this->faker->dateTimeBetween('now', '+7 days'),
            'to_time' => $this->faker->dateTimeBetween('+8 days', '+14 days'),
        ];
    }
}
