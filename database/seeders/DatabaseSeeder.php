<?php

namespace Database\Seeders;

use Eloquent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

            // Call the php artisan migrate:fresh using Artisan
            $this->command->call('migrate:fresh');

            $this->command->line('Database cleared.');
        }

        $this->call([
            FacultySeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
            BatchSeeder::class,
            PersonSeeder::class,
        ]);

        $this->command->info('Database seeded.');

        // Re Guard model
        Eloquent::reguard();
    }
}
