<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductOrderDetailsTest extends TestCase
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
    public function it_gets_product_order_details()
    {
        $product = Product::factory()->create();
        $orderDetails = OrderDetail::factory()
            ->count(2)
            ->create([
                'product_id' => $product->id,
            ]);

        $response = $this->getJson(
            route('api.products.order-details.index', $product)
        );

        $response->assertOk()->assertSee($orderDetails[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_product_order_details()
    {
        $product = Product::factory()->create();
        $data = OrderDetail::factory()
            ->make([
                'product_id' => $product->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.products.order-details.store', $product),
            $data
        );

        unset($data['price']);
        unset($data['quantity']);
        unset($data['order_id']);
        unset($data['product_id']);

        $this->assertDatabaseHas('order_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $orderDetail = OrderDetail::latest('id')->first();

        $this->assertEquals($product->id, $orderDetail->product_id);
    }
}
