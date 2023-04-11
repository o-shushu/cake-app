<?php

namespace Tests\Feature;

use App\Models\Cakecontent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Cake;
use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_is_placed_cart()
    {
        //カートに入れる
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

        $cakecontent = Cakecontent::create([
            'cake_id' => $cake->id,
            'cake_price' => 800,
            'cake_size' => '1号',
        ]);

        $this->actingAs($user1)
        ->post('/user/inputCart', [
            'cake_id' => $cake->id,
            'amount'=> 1,
            'price'=> $cakecontent->cake_price,
            'shop_id'=> $shop->id,

        ])
        ->assertStatus(200);

        return $user1;
    }

    /**
     * @depends test_product_is_placed_cart
     */
    public function test_cart_be_edited($user1)
    {
        $cart =Cart::find(1);
        //カートの商品編集
        $this->actingAs($user1)
            ->post('/user/editCart', [
                'cartId' => $cart->id,
                'cake_amount'=> 3,
                'price'=> $cart->price,
            ]);
            
        $this->assertDatabaseHas('carts', [
            'id' => $cart->id,
            'amount'=> 3,
            'price'=> $cart->price,
        ]);

        return $cart;
    }

    /**
     * @depends test_product_is_placed_cart
     * @depends test_cart_be_edited
     */
    public function test_cart_be_deleted($user1,$cart)
    {
        //カートに商品を削除
        $this->actingAs($user1)
            ->get('/user/deleteCart/'.$cart->id);

        $this->assertDatabaseMissing('carts', [
            'id' => $cart->id,
        ]);

    }

    public function test_user_can_pay()
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

        $cakecontent = Cakecontent::create([
            'cake_id' => $cake->id,
            'cake_price' => 800,
            'cake_size' => '1号',
        ]);

        $this->actingAs($user1)
        ->post('/user/inputCart', [
            'cake_id' => $cake->id,
            'amount'=> 1,
            'price'=> $cakecontent->cake_price,
            'shop_id'=> $shop->id,

        ])
        ->assertStatus(200);

        $response = $this->post('/user/orderPay' ,[
            'delivery_place' => '神奈川県青山市南区大垣町近藤5-5-2 コーポ中津川107号',
            'appointment_time' => '2023-04-12',
            'total_price' => 864,
            'payment_method' => 'クレジットカード',
            'content' => '無',
        ]);
        $response->assertStatus(302); 

        $this->assertDatabaseHas('orders', [
            'user_id' => $user1->id,
        ]);

        return compact('user1', 'user2', 'shop');
    }

    /**
     * @depends test_user_can_pay
     */
    public function test_order_status_be_edited()
    {
        extract($this->test_user_can_pay());

        $orderId = Order::where('user_id', $user1->id)->first();
        $response = $this->actingAs($user2)->post('/orderStatus',[
            'shop_id' => $shop->id,
            'order_id' => $orderId->id,
            'order_status' => '到着済み',
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('carts', [
            'order_id' => $orderId->id,
            'order_status' => '到着済み',
        ]);

    }

    /**
     * @depends test_user_can_pay
     */
    public function test_user_delete_buyCode()
    {
        extract($this->test_user_can_pay());

        $response = $this->actingAs($user1)->get('user/buyCode');
        $response->assertStatus(200);

        $order = Order::where('user_id',$user1->id)->first();
        $response = $this->get('user/buyCodeDelete/'.$order->id)->assertStatus(200);

        $order = Order::where('id',$order->id)->first();
        $this->assertTrue($order->flag == 0);
    }

}
