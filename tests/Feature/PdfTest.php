<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;

class PdfTest extends TestCase
{
     //売上情報閲覧
     public function test_proceeds_can_display_and_output_Pdf()
     {
        $user = User::factory()->create([
            'type' =>2,
        ]);
        Shop::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->actingAs($user)->get('/proceeds');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/output_pdf');
        $response->assertStatus(200);
     }
}
