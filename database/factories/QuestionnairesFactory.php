<?php

namespace Database\Factories;

use App\Models\Questionnaires;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionnairesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Questionnaires::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'validityfrom' => $this->faker->date,
            'validityto' => $this->faker->date,
            'active' => $this->faker->randomDigitNotNull,
            'basicpackage' => $this->faker->randomDigitNotNull,
            'qrcode' => $this->faker->word,
            'description' => $this->faker->word,
        ];
    }
}
