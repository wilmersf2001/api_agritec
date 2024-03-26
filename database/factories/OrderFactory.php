<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_code' => $this->faker->unique()->randomNumber(8),
            'customer_name' => $this->faker->name,
            'customer_ap_paterno' => $this->faker->lastName,
            'customer_ap_materno' => $this->faker->lastName,
            'customer_phone' => $this->faker->phoneNumber,
            'customer_address' => $this->faker->address,
            'customer_email' => $this->faker->unique()->safeEmail,
            'customer_note' => $this->faker->sentence,
            'payment_method' => $this->faker->randomElement(['cash', 'credit_card']),
            'subtotal' => $this->faker->randomFloat(2, 0, 1000),
            'tax' => $this->faker->randomFloat(2, 0, 100),
            'total' => $this->faker->randomFloat(2, 0, 1000),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed']),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
