<?php

namespace Database\Factories\V1;

use App\Models\V1\User;
use App\Models\V1\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\V1\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->name;

        $user = User::inRandomOrder()->first();
        $client = Client::inRandomOrder()->first();

        return [
            'client_id' => $client->id,
            'user_created' => $user->id,
            'slug' => strtolower(Str::slug($title, '-')),
            'title' => $title,
            'description' => $this->faker->paragraph,
            'body' => $this->faker->paragraph,
            'notes' => $this->faker->paragraph,
        ];
    }
}
