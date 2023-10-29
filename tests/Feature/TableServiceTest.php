<?php

use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Services\TableService;
use App\Repositories\Table\TableRepository;

class TableServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $user;
    private $order;
    private $orderDetail;
    private $meal;
    private $table;
    private $reservation;
    /**
     * @var \Illuminate\Testing\TestResponse
     */
    private $response;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->table = Table::factory()->create();
        $this->meal = \App\Models\Meal::factory()->create();
        $this->reservation = \App\Models\Reservation::factory()->create();
        $this->order = \App\Models\Order::factory()->create();
        $this->orderDetail = \App\Models\OrderDetail::factory()->create();
    }

    public function testCheckAvailability()
    {
        $request = new Request([
            'capacity' => 4,
            'from_time' => '2023-10-30 12:00:00',
            'to_time' => '2023-10-30 14:00:00',
            'waiting_list' => true,
            'customer_id' => 12
        ]);

        $response = $this->actingAs($this->user)->postJson('/api/check-availability', $request->all());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotNull($response->getData()->data);
    }
}
