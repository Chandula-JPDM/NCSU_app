<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    // private int $facult_id;

    public function definition()
    {
        return [
            'name' => 'Department of '.$this->faker->unique()->city(),
        ];
    }
}
