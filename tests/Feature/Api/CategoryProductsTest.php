<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryProductsTest extends TestCase
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
    public function it_gets_category_products()
    {
        $category = Category::factory()->create();
        $products = Product::factory()
            ->count(2)
            ->create([
                'category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.products.index', $category)
        );

        $response->assertOk()->assertSee($products[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_category_products()
    {
        $category = Category::factory()->create();
        $data = Product::factory()
            ->make([
                'category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.products.store', $category),
            $data
        );

        $this->assertDatabaseHas('products', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $product = Product::latest('id')->first();

        $this->assertEquals($category->id, $product->category_id);
    }
}
