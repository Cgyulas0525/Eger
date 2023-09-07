<?php

namespace Database\Factories;

use App\Models\Questionnaires;
use App\Models\DetailTypes;
use App\Models\Questionnairedetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionnairedetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Questionnairedetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'questionnaire_id' => Questionnaires::factory()->create(),
            'name' => $this->faker->word,
            'detailtype_id' => DetailTypes::factory()->create(),
            'required' => $this->faker->randomDigitNotNull,
            'readonly' => $this->faker->randomDigitNotNull,
            'long' => $this->faker->randomDigitNotNull,
            'rowcount' => $this->faker->randomDigitNotNull,
            'description' => $this->faker->word,
        ];
    }
}
