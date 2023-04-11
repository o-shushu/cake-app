<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserToken;

class PasswordResetTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_password_reset()
    {
        $user = User::factory()->create([
            'type' =>1,
        ]);
    //发送邮件
        $response = $this->post('/password_reset/email',[
            'email' => $user->email,
        ]);
        $response->assertStatus(302);

        $userToken = UserToken::where('user_id', $user->id)->first();
        $tokenParam = ['reset_token' => $userToken->token];
        $url = URL::temporarySignedRoute('password_reset.edit',  Carbon::now()->addHours(48), $tokenParam);
    //点击邮件链接
        $response = $this->get($url);
        $response->assertStatus(200);
    //提交新密码
        $response = $this->post('/password_reset/update', [
            'password' => 'newPassword',
            'password_confirmation' => 'newPassword',
            'reset_token' => $userToken->token,
        ])->assertStatus(302);

        $response = $this->get('/password_reset/edited');
        $response->assertStatus(200);

        $this->assertTrue(Hash::check('newPassword', $user->fresh()->password));
    }
}
