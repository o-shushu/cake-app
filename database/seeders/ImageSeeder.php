<?php

namespace Database\Seeders;

use App\Models\Cake;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'cake_id' => 0,
                'shop_id' => 1,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe1.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 2,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe2.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 3,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe3.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 4,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe4.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 5,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe5.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 6,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe6.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 7,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe7.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 8,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe1.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 9,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe2.jpg',
            ],
            [
                'cake_id' => 0,
                'shop_id' => 10,
                'image_name' => 'cafe1.jpg',
                'tmp_name' => 'storage/insertProducts/cafe3.jpg',
            ],
        ]);
       

        DB::table('images')->insert([
            [
                'cake_id' => 1,
                'shop_id' => 1,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 2,
                'shop_id' => 1,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 3,
                'shop_id' => 1,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 4,
                'shop_id' => 1,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 5,
                'shop_id' => 1,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 6,
                'shop_id' => 2,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 7,
                'shop_id' => 2,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 8,
                'shop_id' => 2,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 9,
                'shop_id' => 2,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 10,
                'shop_id' => 2,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ], 
            [
                'cake_id' => 11,
                'shop_id' => 3,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 12,
                'shop_id' => 3,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 13,
                'shop_id' => 3,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 14,
                'shop_id' => 3,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 15,
                'shop_id' => 3,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 16,
                'shop_id' => 4,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 17,
                'shop_id' => 4,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 18,
                'shop_id' => 4,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 19,
                'shop_id' => 4,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 20,
                'shop_id' => 4,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 21,
                'shop_id' => 5,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 22,
                'shop_id' => 5,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 23,
                'shop_id' => 5,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 24,
                'shop_id' => 5,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 25,
                'shop_id' => 5,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 26,
                'shop_id' => 6,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 27,
                'shop_id' => 6,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 28,
                'shop_id' => 6,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 29,
                'shop_id' => 6,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 30,
                'shop_id' => 6,
                'image_name' => 'cake1.jpg',
                'tmp_name' => 'storage/insertProducts/cake1.jpg',
            ],
            [
                'cake_id' => 31,
                'shop_id' => 7,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 32,
                'shop_id' => 7,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 33,
                'shop_id' => 7,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 34,
                'shop_id' => 7,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 35,
                'shop_id' => 7,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ], 
            [
                'cake_id' => 36,
                'shop_id' => 8,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 37,
                'shop_id' => 8,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 38,
                'shop_id' => 8,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 39,
                'shop_id' => 8,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 40,
                'shop_id' => 8,
                'image_name' => 'cake3.jpg',
                'tmp_name' => 'storage/insertProducts/cake3.jpg',
            ],
            [
                'cake_id' => 41,
                'shop_id' => 9,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 42,
                'shop_id' => 9,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 43,
                'shop_id' => 9,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 44,
                'shop_id' => 9,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 45,
                'shop_id' => 9,
                'image_name' => 'cake4.jpg',
                'tmp_name' => 'storage/insertProducts/cake4.jpg',
            ],
            [
                'cake_id' => 46,
                'shop_id' => 10,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 47,
                'shop_id' => 10,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 48,
                'shop_id' => 10,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 49,
                'shop_id' => 10,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ],
            [
                'cake_id' => 50,
                'shop_id' => 10,
                'image_name' => 'cake5.jpg',
                'tmp_name' => 'storage/insertProducts/cake5.jpg',
            ]
        ]);
    }
}
