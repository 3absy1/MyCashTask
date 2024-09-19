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
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'salary' => $this->faker->randomFloat(2, 3000, 10000), // Random salary between 3000 and 10000
            'image' => null, // For simplicity, leave image null or use a placeholder
            'manager_id' => null, // This will be set in the seeder later
            'department_id' => null, // This will be set in the seeder later
        ];
    }
}
