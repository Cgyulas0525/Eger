<?php

namespace Database\Factories;

use App\Models\Clientquestionnariedetails;
use App\Models\Clientquestionnaries;
use App\Models\Questionnairedetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientquestionnariedetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clientquestionnariedetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'clientquestionnarie_id' => Clientquestionnaries::factory()->create(),
            'questionnariedetail_id' => Questionnairedetails::factory()->create(),
            'reply' => $this->faker->word,
            'description' => $this->faker->word,
        ];
    }
}
