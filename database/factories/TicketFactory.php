<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->name(),
            'email' => $this->faker->email(),
            'serial_number' => $this->faker->randomNumber(9),
            'valid_from' => $this->faker->dateTimeBetween('-2 months', '+2 months'),
            'valid_to' => $this->faker->dateTimeBetween('now', '+ 2 months'),
            'price' => $this->faker->randomFloat(8, 0.01, 20.99),
            'rods' => $this->faker->randomNumber(2)
        ];
    }
}
