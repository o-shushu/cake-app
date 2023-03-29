<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::factory(1)->create([
            'user_id' => 2
        ]);

        Shop::factory(1)->create([
            'user_id' => 3
        ]);

        Shop::factory(1)->create([
            'user_id' => 4
        ]);

        Shop::factory(1)->create([
            'user_id' => 5
        ]);
        Shop::factory(1)->create([
            'user_id' => 6
        ]);
        Shop::factory(1)->create([
            'user_id' => 7
        ]);
        Shop::factory(1)->create([
            'user_id' => 8
        ]);
        Shop::factory(1)->create([
            'user_id' => 9
        ]);
        Shop::factory(1)->create([
            'user_id' => 10
        ]);
        Shop::factory(1)->create([
            'user_id' => 11
        ]);
    }
}
