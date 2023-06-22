<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->sentence(),
            'full_name' => $this->faker->sentence(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password('password'),
//            'image' => $this->faker->imageUrl(640,480),
        ];
    }
}
