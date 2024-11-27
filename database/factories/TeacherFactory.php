<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $table->id();
        // $table->foreignIdFor(User::class);
        // $table->string('first_name');
        // $table->string('last_name');
        // $table->string('middle_name')->nullable();
        // $table->timestamps();
        return [
            'user_id' => User::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'middle_name' => fake()->lastName(),
            'sex' => fake()->randomElement(['male', 'female']),
            'birth_date' => fake()->date('m-d-Y')
        ];
    }
}
