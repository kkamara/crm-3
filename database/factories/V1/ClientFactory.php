<?php

namespace Database\Factories\V1;

use App\Models\V1\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\V1\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Faker's company() word pool is small, so append a unique number rather than relying on unique() over the whole phrase.
        $company = $this->faker->company().' '.$this->faker->unique()->numberBetween(1, 100000000);

        return [
            'slug' => strtolower(Str::slug($company, '-')),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'user_created' => function() {
                return User::factory()->create()->id;
            },
            'company' => $company,
            'contact_number' => $this->faker->phonenumber,
            'building_number' => $this->faker->buildingnumber,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode,
            'email' => $this->faker->unique()->safeEmail,
            'street_name' => $this->faker->StreetAddress,
        ];
    }
}
