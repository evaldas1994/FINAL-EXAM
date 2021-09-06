<?php

namespace Database\Factories;

use App\Models\Lake;
use Illuminate\Database\Eloquent\Factories\Factory;

class LakeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lake::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'region_id' => rand(1, 10)
        ];
    }
}
