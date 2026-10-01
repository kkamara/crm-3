<?php

namespace Database\Factories\V1;

use App\Models\V1\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\V1\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $username = $this->faker->unique()->username;

        while(User::where("username", $username)->first() !== null) {
            $username = $this->faker->unique()->username;
        }

        $email = $this->faker->unique()->safeEmail;

        while(User::where("email", $email)->first() !== null) {
            $email = $this->faker->unique()->safeEmail;
        }

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make("secret"),
            'remember_token' => Str::random(10),
        ];
    }
}
