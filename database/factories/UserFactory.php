<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->unique()->safeEmail;
        return [
            'name' => explode('@', $email)[0],
            'email' => $email,
            'password' => Hash::make('12345'),
            'rol' => $this->faker->randomElement(['vendedor', 'cliente'])
        ];
    }
}
