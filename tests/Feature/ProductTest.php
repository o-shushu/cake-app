<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cake;
use App\Models\User;
use App\Models\Shop;

class ProductTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     *
     */

     //商品新規
    public function test_product_can_create()
    {
        $user = User::factory()->create([
            'type' =>2,
        ]);

        $shop = Shop::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
        ->post('upload/store', [
            'cake_content' => 'お得なイチゴケーキ',
            'cake_name' => 'リンゴイチゴケーキ',
            'cake_category' => 'フルーツケーキ',
            'cakecontent' => [
                ['cake_price' => 300,'cake_size' => '1号',],
                ['cake_price' => 600,'cake_size' => '2号',],
            ],
            'image_path' => 'storage/insertProducts/cake6.jpg',
            'image_name' => 'cake6.jpg',

        ])
        ->assertStatus(302);

        $this->assertDatabaseHas('cakes', [
            'shop_id' => $shop->id,
        ]);

        $response = $this->get('/product');
        $response->assertStatus(200);

        $cake = Cake::where('shop_id',$shop->id)->where('cake_name','リンゴイチゴケーキ')->first();

        return compact('user', 'cake');
    }
    /**
     * @depends test_product_can_create
     */
     //商品編集
     public function test_product_can_edit()
     {
        extract($this->test_product_can_create());

        $this->actingAs($user)
        ->post('store/'.$cake->id, [
            'cake_content' => 'お得なイチゴケーキ',
            'cake_name' => 'イチゴクリームケーキ',
            'cake_category' => 'フルーツケーキ',
            'cakecontent' => [
                ['cake_price' => 200,'cake_size' => '1号',],
                ['cake_price' => 400,'cake_size' => '2号',],
                ['cake_price' => 600,'cake_size' => '3号',],
            ],
            'image_path' => 'storage/insertProducts/cake6.jpg',
            'image_name' => 'cake6.jpg',

        ])->assertStatus(302);

        $this->assertDatabaseHas('cakes', [
            'id' => $cake->id,
            'cake_name' => 'イチゴクリームケーキ',
        ]);
     }

    /**
     * @depends test_product_can_create
     */
     //商品削除
     public function test_product_can_delete()
     {
        extract($this->test_product_can_create());

        $this->actingAs($user)
        ->delete('product/detail/delete/'.$cake->id)->assertStatus(302);

        $this->assertDatabaseMissing('cakes', [
            'id' => $cake->id,
        ]);

     }
}
