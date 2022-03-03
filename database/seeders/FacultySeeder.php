<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculty_list = [
            ['id'=> 1, 'name'=>'Faculty of Agriculture', 'facultyCode'=>'AG'],
            ['id'=> 2, 'name'=>'Faculty of Arts', 'facultyCode'=>'A'],
            ['id'=> 3, 'name'=>'Faculty of Dental Sciences', 'facultyCode'=>'D'],
            ['id'=> 4, 'name'=>'Faculty of Engineering', 'facultyCode'=>'E'],
            ['id'=> 5, 'name'=>'Faculty of Medicine', 'facultyCode'=>'M'],
            ['id'=> 6, 'name'=>'Faculty of Science', 'facultyCode'=>'S'],
            ['id'=> 7, 'name'=>'Faculty of Veterinary Medicine and Animal Science', 'facultyCode'=>'V'],
            ['id'=> 8, 'name'=>'Faculty of Allied Health Sciences', 'facultyCode'=>'AH'],
            ['id'=> 9, 'name'=>'Faculty of Management', 'facultyCode'=>'MN'],
        ];

        // If the table faculties has no data, seed them with dummy data
        if (DB::table('faculties')->count() == 0) {
            foreach ($faculty_list as $faculty) {
                Faculty::create($faculty);
            }
        }
    }
}
