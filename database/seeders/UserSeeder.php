<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //管理者
        User::create([
            'name' => '管理者オウ',
            'email' => 'testou@email.com',
            'password' =>'password',
            'tel' => 1234567890,
            'residence_id' => 1,
            'type' => 0

        ]);
        //会員ユーザー
        User::create([
            'name' => '田辺 香織',
            'email' => 'sakura@s89fbavi.shop',
            'password' =>'password',
            'tel' => '09084300866',
            'residence_id' => 1,
            'type' => 1

        ]);
        //営業ユーザー
        User::create([
            'name' => '宮沢 学',
            'email' => 'kumiko63@ito.com',
            'password' =>'password',
            'tel' => '09006746119',
            'residence_id' => 2,
            'type' => 2

        ]);
        
        //営業ユーザー
        User::factory(14)->create([
            'type' => 2
        ]);

        //会員ユーザー
        User::factory(14)->create([
            'type' => 1
        ]);
    }
}
