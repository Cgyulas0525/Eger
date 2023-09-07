<?php

namespace Database\Factories;

use App\Models\DetailTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailTypes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'listing' => $this->faker->randomDigitNotNull,
            'description' => $this->faker->word,
        ];
    }
}
