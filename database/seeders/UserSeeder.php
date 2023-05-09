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
        
        //営業ユーザー
        User::factory(10)->create([
            'type' => 2
        ]);

        //会員ユーザー
        User::factory(15)->create([
            'type' => 1
        ]);
    }
}
