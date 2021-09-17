<?php

namespace Database\Factories;

use App\Models\Lake;
use Illuminate\Database\Eloquent\Factories\Factory;

class LakeFactory extends Factory
{
    protected $model = Lake::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'region_id' => rand(1, 10)
        ];
    }
}
