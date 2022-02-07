<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department_list = [
            ['faculty_id'=> 4, 'name'=> 'Department of Chemical & Process Engineering'],
            ['faculty_id'=> 4, 'name'=> 'Department of Civil Engineering'],
            ['faculty_id'=> 4, 'name'=> 'Department of Computer Engineering'],
            ['faculty_id'=> 4, 'name'=> 'Department of Electrical & Electronic Engineering'],
            ['faculty_id'=> 4, 'name'=> 'Department of Engineering Mathematics'],
            ['faculty_id'=> 4, 'name'=> 'Department of Mechanical Engineering'],
            ['faculty_id'=> 4, 'name'=> 'Department of Manufacturing & Industrial Engineering'],
            ['faculty_id'=> 4, 'name'=> 'Department of Engineering Management']
        ];

        // If the table departments has no data, seed them with dummy data
        if (DB::table('departments')->count() == 0) {
            foreach ($department_list as $department) {
                Department::create($department);
            }
        }
    }
}
