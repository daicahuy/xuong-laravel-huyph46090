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
            "first_name"        =>   $this->faker->firstName(),
            "last_name"         =>   $this->faker->lastName(),
            "email"             =>   $this->faker->email(),
            "phone"             =>   $this->faker->phoneNumber(),
            "date_of_birth"     =>   $this->faker->date(),
            "hire_date"         =>   $this->faker->dateTime(),
            "salary"            =>   $this->faker->randomFloat(0, 1000000, 100000000),
            "is_active"         =>   $this->faker->numberBetween(0, 1),
            "department_id"     =>   rand(0, 10),
            "manager_id"        =>   rand(0, 10),
            "address"           =>   $this->faker->address,
            "profile_picture"   =>   'images/hehe.jpg',
        ];
    }
}
