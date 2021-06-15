<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Shop;
use App\Models\Product;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopProductsTest extends TestCase
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
    public function it_gets_shop_products()
    {
        $shop = Shop::factory()->create();
        $products = Product::factory()
            ->count(2)
            ->create([
                'shop_id' => $shop->id,
            ]);

        $response = $this->getJson(route('api.shops.products.index', $shop));

        $response->assertOk()->assertSee($products[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_shop_products()
    {
        $shop = Shop::factory()->create();
        $data = Product::factory()
            ->make([
                'shop_id' => $shop->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.shops.products.store', $shop),
            $data
        );

        $this->assertDatabaseHas('products', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $product = Product::latest('id')->first();

        $this->assertEquals($shop->id, $product->shop_id);
    }
}
