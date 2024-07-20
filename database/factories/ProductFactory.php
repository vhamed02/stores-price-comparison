<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'title'     => $this->faker->words(6, true),
            'slug'      => $this->faker->slug(5),
            'thumbnail' => $this->faker->imageUrl(320, 280),
        ];
    }
}
