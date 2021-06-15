<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductDetail;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductProductDetailsTest extends TestCase
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
    public function it_gets_product_product_details()
    {
        $product = Product::factory()->create();
        $productDetails = ProductDetail::factory()
            ->count(2)
            ->create([
                'product_id' => $product->id,
            ]);

        $response = $this->getJson(
            route('api.products.product-details.index', $product)
        );

        $response->assertOk()->assertSee($productDetails[0]->color);
    }

    /**
     * @test
     */
    public function it_stores_the_product_product_details()
    {
        $product = Product::factory()->create();
        $data = ProductDetail::factory()
            ->make([
                'product_id' => $product->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.products.product-details.store', $product),
            $data
        );

        unset($data['price']);
        unset($data['color']);
        unset($data['size']);
        unset($data['discount_type']);
        unset($data['discount']);
        unset($data['description']);
        unset($data['product_id']);

        $this->assertDatabaseHas('product_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $productDetail = ProductDetail::latest('id')->first();

        $this->assertEquals($product->id, $productDetail->product_id);
    }
}
