<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * 
     * @group users
     * 
     * @return void
     */
    public function test_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('人気店')
                    ->clickLink('ログイン')
                    ->assertPathIs('/login')
                    ->clickLink('新規')
                    ->assertPathIs('/register')
                    ->type('name', 'deliCake')
                    ->type('email', 'deliCake@email.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->type('tel', '01012345678')
                    ->select('select[name=residence]', '1')
                    ->select('select[name=type]', '1')
                    ->press('登録')
                    ->waitForText('新規登録完了しました。ログインしてください。')
                    ->assertSee('新規登録完了しました。ログインしてください。');       
        });
    }
    
    public function test_password_rest()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->clickLink('パスワードを忘れた方はこちら')
                    ->assertPathIs('/password_reset/email')
                    ->type('email', 'deliCake@email.com')
                    ->press('再設定用メールを送信')
                    ->waitForText('パスワードリセットメールを送信しました。')
                    ->assertSee('パスワードリセットメールを送信しました。');
                    
        });
    }

    public function test_login()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/login')
                    ->type('email', 'deliCake@email.com')
                    ->type('password', 'password')
                    ->press('ログイン')
                    ->assertPathIs('/')
                    ->assertSee('deliCake');
        });
    }
}
