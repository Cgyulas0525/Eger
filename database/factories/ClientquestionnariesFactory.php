<?php

namespace Database\Factories;

use App\Models\Clientquestionnaries;
use App\Models\Questionnaires;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clients;

class ClientquestionnariesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clientquestionnaries::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'client_id' => Clients::factory()->create(),
            'questionnarie_id' => Questionnaires::factory()->create(),
            'posted' => $this->faker->date,
            'retrieved' => $this->faker->date,
            'description' => $this->faker->word,
        ];
    }
}
