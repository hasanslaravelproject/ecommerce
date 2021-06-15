<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderOrderDetailsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_order_order_details()
    {
        $order = Order::factory()->create();
        $orderDetails = OrderDetail::factory()
            ->count(2)
            ->create([
                'order_id' => $order->id,
            ]);

        $response = $this->getJson(
            route('api.orders.order-details.index', $order)
        );

        $response->assertOk()->assertSee($orderDetails[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_order_order_details()
    {
        $order = Order::factory()->create();
        $data = OrderDetail::factory()
            ->make([
                'order_id' => $order->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.orders.order-details.store', $order),
            $data
        );

        unset($data['price']);
        unset($data['quantity']);
        unset($data['order_id']);
        unset($data['product_id']);

        $this->assertDatabaseHas('order_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $orderDetail = OrderDetail::latest('id')->first();

        $this->assertEquals($order->id, $orderDetail->order_id);
    }
}
