<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

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
            'reservation_id' => function () {
                return Reservation::factory()->create()->id;
            },
            'customer_id' => function () {
                return Customer::factory()->create()->id;
            },
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'total' => $this->faker->randomFloat(2, 10, 200),
            'paid' => $this->faker->boolean,
            'date' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
