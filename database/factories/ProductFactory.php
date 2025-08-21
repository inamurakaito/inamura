<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company; // ← 追加

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),           // ← これが肝
            'name'       => $this->faker->words(2, true),
            'sku'        => $this->faker->unique()->ean8(),
            'price'      => $this->faker->numberBetween(100, 5000),
            'stock'      => $this->faker->numberBetween(0, 200),
            'status'     => $this->faker->randomElement(['draft','active','archived']),
            'description'=> $this->faker->sentence(12),
        ];
    }
}
