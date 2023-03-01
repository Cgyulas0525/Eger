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
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'validityfrom' => $this->faker->word,
            'validityto' => $this->faker->word,
            'active' => $this->faker->randomDigitNotNull,
            'basicpackage' => $this->faker->randomDigitNotNull,
            'qrcode' => $this->faker->word,
            'description' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
