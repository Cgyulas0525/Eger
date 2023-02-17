<?php

namespace Database\Factories;

use App\Models\Vouchertypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class VouchertypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vouchertypes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'local' => $this->faker->randomDigitNotNull,
        'localfund' => $this->faker->randomDigitNotNull,
        'localreplay' => $this->faker->randomDigitNotNull,
        'otherfund' => $this->faker->randomDigitNotNull,
        'otherreplay' => $this->faker->randomDigitNotNull,
        'description' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
