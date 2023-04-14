<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $phone = $this->faker->phoneNumber;
        $phone = preg_replace("/[^0-9]/", "", $phone);
        return [
            'user_id' => User::factory(),
            'shop_name' => fake()->streetName() . '店',
            'residence' => fake()->address(),
            'tel' => $phone,
            'remark' => $this->faker->sentence(5),
        ];
    }
}
