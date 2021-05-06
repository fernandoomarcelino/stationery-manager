<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->randomNumber(9),
            'date_birth' => $this->faker->date('Y-m-d'),
            'address' => $this->faker->realText(200),
            'complement' => $this->faker->realText(150),
            'neighborhood' => $this->faker->realText(200),
            'zipcode' => $this->faker->randomNumber(8),
        ];
    }
}
