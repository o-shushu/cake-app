<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' =>'password',
            'tel' => $phone,
            'residence_id' => rand(1,47) ,
            'type' => rand(1,2)
        ];
    }
}
