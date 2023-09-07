<?php

namespace Database\Factories;

use App\Models\Questionnairedetailitems;
use App\Models\Questionnairedetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionnairedetailitemsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Questionnairedetailitems::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'questionnariedetail_id' => Questionnairedetails::factory()->create(),
            'value' => $this->faker->word,
        ];
    }
}
