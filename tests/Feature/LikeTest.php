<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cakecontent;
use App\Models\User;
use App\Models\Shop;
use App\Models\Cake;
use App\Models\Image;


class LikeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_shop_add_like()
    {
    // 模拟登录用户
    $user1 = User::factory()->create([
        'type' =>1,
    ]);

    $user2 = User::factory()->create([
        'type' =>2,
    ]);
    $shop = Shop::factory()->create([
        'user_id'=> $user2->id,
    ]);
    $this->actingAs($user1);

    // 发送点赞请求
    $response = $this->post('shop/like' ,[
        'shop_id' => $shop->id,
    ]);

    // 断言接口返回状态码为 200
    $response->assertStatus(200);

    // 断言点赞成功
    $userId = $user1->id;
    $shopId= $shop->id;
    $this->assertTrue($shop->like_exist($userId,$shopId));
    }

    public function test_user_can_product_add_like()
    {
        $user1 = User::factory()->create([
            'type' =>1,
        ]);
        $user2 = User::factory()->create([
            'type' =>2,
        ]);
        $shop = Shop::factory()->create([
            'user_id' => $user2->id,
        ]);
        $cake = Cake::create([
            'shop_id' => $shop->id,
            'cake_name' => 'リンゴイチゴケーキ',
            'cake_category' =>'フルーツケーキ',
            'cake_content' =>'美味しいケーキ',
        ]);
        Image::create([
            'cake_id' =>$cake->id,
            'shop_id' => $shop->id,
            'image_name' => 'cake6',
            'image_type' => 'jpg',
            'tmp_name' => 'storage/insertProducts/cake6.jpg',
        ]);

        Cakecontent::create([
            'cake_id' => $cake->id,
            'cake_price' => 800,
            'cake_size' => '1号',
        ]);

        $this->actingAs($user1);

        $response = $this->post('/cake/like' ,[
            'cake_id' => $cake->id,
        ]);
        $response->assertStatus(200);

        $userId = $user1->id;
        $cakeId= $cake->id;
        $this->assertTrue($cake->like_exist($userId,$cakeId));
    }

}
