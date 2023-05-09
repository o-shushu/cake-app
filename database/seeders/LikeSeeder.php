<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;
use Carbon\Carbon;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = Shop::all();

        foreach($shops as $shop){
            for($i=0; $i<10; $i++){
                DB::table('likes')->insert([
                    [
                        'user_id' => rand(12,26),
                        'cake_id' => null,
                        'shop_id' => $shop->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                    [
                        'user_id' => rand(12,26),
                        'cake_id' => rand(1,50),
                        'shop_id' => null,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        ]
                    ]);
                }
            }
    }
}
