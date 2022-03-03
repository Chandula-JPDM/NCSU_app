<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $Gender = array_rand(['male', 'female']);
        $firstName = $this->faker->firstName($gender = $Gender, $maxNbChars = 20);
        $middleName = $this->faker->firstName($gender = $Gender, $maxNbChars = 20);
        $lastName = $this->faker->lastName($maxNbChars = 20);
        $city = $this->faker->city($maxNbChars = 80);

        // Get random faculty id and batch id from the database
        $fac = Faculty::inRandomOrder()->first();
        $batch = Batch::inRandomOrder()->first()->id;

        return [
            'fname' => $firstName,

            'lname' => $lastName,

            'username' => $firstName.$this->faker->unique()->randomNumber($nbDigits = 5, $strict = true),

            'email' => $this->faker->unique()->email(),

            'fullname' => $firstName.' '.$middleName.' '.$lastName,

            'initial' => $firstName[0].'.'.$middleName[0].'. '.$lastName,

            'address' => $this->faker->streetAddress().', '.$city.', '.$this->faker->state().' '.$this->faker->postcode(),

            'city' => $city,

            'date' => $this->faker->date($format = 'Y-m-d', $maxNbChars = 'now'),

            'regNo' => $fac->facultyCode.'/'.$batch.'/'.$this->faker->unique()->randomNumber($nbDigits = 3, $strict = true),

            'image' => $this->faker->imageUrl($width = 400, $height = 400, 'cats'),

            'faculty_id' => $fac->id ?? 4,

            'batch_id' => $batch ?? 16,

            'department_id' => Department::inRandomOrder()->where('faculty_id', $fac->id ?? 4)->first()->id ?? 1,
        ];
    }
}
