<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // 各テーブルへのデータの流し込みを呼び出す
        $this->call(ResidencesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(CakeSeeder::class);
        $this->call(ImageSeeder::class);

    }
}
