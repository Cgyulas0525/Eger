<?php

namespace Database\Factories;

use App\Models\Usertypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsertypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usertypes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'commit' => $this->faker->word,
        ];
    }
}
