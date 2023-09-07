<?php

namespace Database\Factories;

use App\Models\Vouchers;
use App\Models\Vouchertypes;
use App\Models\Partners;
use Illuminate\Database\Eloquent\Factories\Factory;

class VouchersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vouchers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'vouchertype_id' => Vouchertypes::factory()->create(),
            'partner_id' => Partners::factory()->create(),
            'content' => $this->faker->word,
            'validityfrom' => $this->faker->date,
            'validityto' => $this->faker->date,
            'qrcode' => $this->faker->word,
            'discount' => $this->faker->randomDigitNotNull,
            'discountpercent' => $this->faker->randomDigitNotNull,
            'usednumber' => $this->faker->randomDigitNotNull,
            'active' => $this->faker->randomDigitNotNull,
        ];
    }
}
