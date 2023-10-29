<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(MealSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderDetailSeeder::class);
    }
}
