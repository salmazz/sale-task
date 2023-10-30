<?php

namespace Tests\Feature;

use App\Models\Meal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MealItemsTest extends TestCase
{
    use RefreshDatabase;

    public function testListMenuSuccessfully()
    {
        Meal::factory(20)->create();

        $response = $this->getJson('/api/list-menu-items');

        $response->assertOk()
            ->assertJsonCount(20);
    }

    /**
     * Test that database table of hotel expected that columns
     */
    public function testMealDatabaseHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('meals', [
                'price',
                'description',
                'available_quantity',
                'initial_quantity',
                'discount',
            ]), 1);
    }
}
