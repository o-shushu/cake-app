<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
   
    use WithFaker;
    // use DatabaseMigrations;

    // public function setUp():void 
    // {
    //     parent::setUp();
    //     $this->runDatabaseMigrations();
    //     $this->seed();
    // }
    protected $seed = true;
    
    //ホームページ接続
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    //ログインページ接続
    public function test_can_access_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
 
    //新規登録機能
    public function test_user_can_register()
    {
        $password = 'password';
        $phone = $this->faker->phoneNumber;
        $phone = preg_replace("/[^0-9]/", "", $phone);

        $response = $this->post('/register', [
            'name' => 'Test2023',
            'email' => 'Test2023@test.com',
            'password' => $password,
            'password_confirmation' => $password,
            'tel' => $phone,
            'residence' => 1,
            'type' => 1,
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'Test2023',
            'email' => 'Test2023@test.com',
        ]);
    }

    public function test_user_can_login()
    {
       $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => 'password',
        'type' => 1,
    ]);

    $response = $this->post('/login', [
        'email' =>  $user->email,
        'password' => 'password',
    ]);
    $response->assertStatus(302);
 
    $this->assertAuthenticatedAs($user);
    }


}
