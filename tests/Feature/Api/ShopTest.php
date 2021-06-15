<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Shop;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShopTest extends TestCase
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
    public function it_gets_shops_list()
    {
        $shops = Shop::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.shops.index'));

        $response->assertOk()->assertSee($shops[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_shop()
    {
        $data = Shop::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.shops.store'), $data);

        unset($data['password']);

        $this->assertDatabaseHas('shops', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_shop()
    {
        $shop = Shop::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'email' => $this->faker->email,
            'profile_image' => $this->faker->text(255),
            'status' => 'Inactive',
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(route('api.shops.update', $shop), $data);

        unset($data['password']);

        $data['id'] = $shop->id;

        $this->assertDatabaseHas('shops', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_shop()
    {
        $shop = Shop::factory()->create();

        $response = $this->deleteJson(route('api.shops.destroy', $shop));

        $this->assertDeleted($shop);

        $response->assertNoContent();
    }
}
