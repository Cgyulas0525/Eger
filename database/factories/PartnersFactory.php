<?php

namespace Database\Factories;

use App\Models\Partners;
use App\Models\PartnerTypes;
use App\Models\Settlements;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partners::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'partnertype_id' => PartnerTypes::factory()->create(),
            'taxnumber' => $this->faker->word,
            'bankaccount' => $this->faker->word,
            'postcode' => $this->faker->randomDigitNotNull,
            'settlement_id' => Settlements::factory()->create(),
            'address' => $this->faker->word,
            'email' => $this->faker->word,
            'phonenumber' => $this->faker->word,
            'description' => $this->faker->word,
            'active' => $this->faker->randomDigitNotNull,
            'logourl' => $this->faker->word,
        ];
    }
}
