<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list = [
            [
                'faculty_id'=> 4,
                'name'=>'admin',
                'username'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make('admin12345'),
                'remark'=>'Superadmin user',
                'active'=>1,
                'is_admin'=>1,

            ],
            [
                'faculty_id'=> 3,
                'name'=>'user',
                'username'=>'user',
                'email'=>'user@user.com',
                'password'=>Hash::make('admin12345'),
                'remark'=>'admin user',
                'active'=>1,
                'is_admin'=>0,

            ],
            [
                'faculty_id'=> 2,
                'name'=>'test',
                'username'=>'test',
                'email'=>'test@test.com',
                'password'=>Hash::make('admin12345'),
                'remark'=>'Superadmin user',
                'active'=>1,
                'is_admin'=>1,

            ],
            [
                'faculty_id'=> 1,
                'name'=>'lucifer',
                'username'=>'lucifer',
                'email'=>'lucifer@lucifer.com',
                'password'=>Hash::make('admin12345'),
                'remark'=>'admin user',
                'active'=>1,
                'is_admin'=>0,

            ],
            [
                'faculty_id'=> 4,
                'name'=>'efacadmin',
                'username'=>'efac',
                'email'=>'efac@efac.com',
                'password'=>Hash::make('admin12345'),
                'remark'=>'admin user for efac',
                'active'=>1,
                'is_admin'=>0,

            ],
        ];

        // If the table users has no data, seed them with dummy data
        if (DB::table('users')->count() == 0) {
            foreach ($user_list as $user) {
                User::create($user);
            }
        }
    }
}
