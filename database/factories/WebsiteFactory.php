<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'title'       => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'url'         => 'https://' . $this->faker->domainName(),
            'seller_id'   => Seller::all()->random()->id,
        ];
    }
}
