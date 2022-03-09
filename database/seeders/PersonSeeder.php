<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many persons you need, defaulting to 10
        $personCount = (int) $this->command->ask('How many people do you need ?', 10);

        $this->command->info("Creating {$personCount} people...");

        // Create the People
        Person::factory()->count($personCount)->create();
    }
}
