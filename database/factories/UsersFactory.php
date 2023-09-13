<?php

namespace Database\Factories;

use App\Models\Users;
use App\Models\Usertypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Users::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->word,
            'email' => $this->faker->email,
            'email_verified_at' => $this->faker->date('Y-m-d H:i:s'),
            'password' => $this->faker->password,
            'remember_token' => $this->faker->word,
            'image_url' => $this->faker->word,
            'usertypes_id' => Usertypes::factory()->create(),
            'commit' => $this->faker->word,
        ];
    }
}
