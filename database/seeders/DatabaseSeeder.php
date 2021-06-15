<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductDetailSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(OrderDetailSeeder::class);
    }
}
