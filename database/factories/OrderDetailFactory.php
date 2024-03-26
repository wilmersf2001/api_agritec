<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->name,
            'product_price' => $this->faker->randomFloat(2, 0, 1000),
            'product_qty' => $this->faker->randomNumber(2),
            'product_subtotal' => $this->faker->randomFloat(2, 0, 1000),
            'order_id' => \App\Models\Order::factory(),
        ];
    }
}
