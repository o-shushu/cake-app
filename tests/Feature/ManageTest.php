<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Image;

class ManageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_manage_likes_display()
    {
        $manager = User::where('type', 0)->first();

        //店舗いいね一覧
        $response = $this->actingAS($manager)->get('manage/shop/likes');
        $response->assertStatus(200);
        //商品いいね一覧
        $response = $this->actingAS($manager)->get('manage/cake/likes');
        $response->assertStatus(200);
    }

    //ユーザー編集
    public function test_manage_users_information()
    {
        $manager = User::where('type', 0)->first();
        $randomUser = User::inRandomOrder()->first();

        $this->actingAS($manager)->post('user/store', [
            'userId' => $randomUser->id,
            'name' => $randomUser->name,
            'email' => $randomUser->email,
            'tel' => '08040742275',
            'residence' => 47,
        ])->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $randomUser->id,
            'tel' => '08040742275',
            'residence_id' => 47,
        ]);
    }

    //ユーザー削除
    public function test_delete_users()
    { 
        $manager = User::where('type', 0)->first();
        $randomUser = User::whereNot('type', '=', 0)->inRandomOrder()->first();

        $this->actingAS($manager)
            ->get('/manage/delete/'.$randomUser->id)
            ->assertStatus(302);

        $this->assertDatabaseMissing('users', [
            'id' => $randomUser->id,
        ]);
    }

     //店舗情報編集
     public function test_change_shop_information()
     { 
        $manager = User::where('type', 0)->first();
        $randomUser = User::inRandomOrder()->where('type', 2)->first();
        $shop = Shop::factory()->create([
            'user_id' => $randomUser->id,
        ]);
        $image = Image::create([
            'cake_id' =>0,
            'shop_id' => $shop->id,
            'image_name' => 'cafe1',
            'image_type' => 'jpg',
            'tmp_name' => 'storage/insertProducts/cafe1.jpg',
        ])->first();
        $response = $this->actingAS($manager)->get('shop/detail/'.$randomUser->id);
        $response->assertStatus(200);

        $this->actingAS($manager)
            ->post('/shop/store',[
                'image_path' => $image->tmp_name,
                'image_name' => $image->image_name,
                'image_type' => $image->image_type,
                'shop_name' => $shop->shop_name,
                'residence' => $shop->residence,
                'shopId' => $shop->id,
                'tel' => '0045892311',
                'remark' => '人の幸せのため、みんなが好きなケーキを作る',
            ])
            ->assertStatus(302);

        $this->assertDatabaseHas('shops', [
            'id' => $shop->id,
            'tel' => '0045892311',
            'remark' => '人の幸せのため、みんなが好きなケーキを作る',
        ]);
     }
}
