<?php

namespace Database\Seeders;

use App\Models\Cake;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cake_names = [
            '桜色ショートケーキ', 
            'チーズケーキ', 
            'チョコレートシフォンケーキ',
            'イチゴのパーティーケーキ',
            'フルーツロールケーキ',
            'モンブランスペシャルケーキ',
            '濃茶のケーキ',
            'チョコレートケーキ',
        ];

        $shops = Shop::all();

        foreach($shops as $shop){
            DB::table('cakes')->insert([
                [
                    'shop_id' => $shop->id,
                    'cake_name' => $cake_names[array_rand($cake_names, 1)],
                    'cake_category' => 'ケーキ',
                    'cake_content' => 'テスト',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'shop_id' => $shop->id,
                    'cake_name' => $cake_names[array_rand($cake_names, 1)],
                    'cake_category' => 'ケーキ',
                    'cake_content' => 'テスト',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'shop_id' => $shop->id,
                    'cake_name' => $cake_names[array_rand($cake_names, 1)],
                    'cake_category' => 'ケーキ',
                    'cake_content' => 'テスト',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'shop_id' => $shop->id,
                    'cake_name' => $cake_names[array_rand($cake_names, 1)],
                    'cake_category' => 'ケーキ',
                    'cake_content' => 'テスト',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'shop_id' => $shop->id,
                    'cake_name' => $cake_names[array_rand($cake_names, 1)],
                    'cake_category' => 'ケーキ',
                    'cake_content' => 'テスト',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
        }

        $cakes = Cake::all();

        foreach($cakes as $cake){
            DB::table('cakecontent')->insert([
                [
                    'cake_id' => $cake->id,
                    'cake_price' => 800,
                    'cake_size' => '1号',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'cake_id' => $cake->id,
                    'cake_price' => 1500,
                    'cake_size' => '2号',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'cake_id' => $cake->id,
                    'cake_price' => 2500,
                    'cake_size' => '3号',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
        }
    }
}
