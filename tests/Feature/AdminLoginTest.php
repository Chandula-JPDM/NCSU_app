<?php

namespace Tests\Feature;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_admin_can_login_to_the_system()
    {
        $this->withoutExceptionHandling();

        //we want to create a faculty
        Faculty::create([
            'id'=> 1, 'name'=>'Faculty of Agriculture', 'facultyCode'=>'AG',
        ]);

        //we want to create a user
        $user = User::factory()->create(['is_admin'=>false]);

        //check user can authendicate
        $this->actingAs($user);

        $response = $this->get('/profile');

        $response->assertStatus(200);
    }

    public function test_a_super_admin_can_go_to_create_new_user_page()
    {
        $this->withoutExceptionHandling();

        //we want to create a faculty
        Faculty::create([
            'id'=> 1, 'name'=>'Faculty of Agriculture', 'facultyCode'=>'AG',
        ]);

        //we want to create a user
        $user = User::factory()->create(['is_admin' => 1]);

        //check user can authedicate
        $this->actingAs($user);

        $response = $this->get('/profile/create');
        $response->assertStatus(200);
    }

    public function test_a_super_admin_can_go_to_add_new_faculty_page()
    {
        $this->withoutExceptionHandling();

        //we want to create a faculty
        Faculty::create([
            'id'=> 1, 'name'=>'Faculty of Agriculture', 'facultyCode'=>'AG',
        ]);

        //we want to create a user
        $user = User::factory()->create(['is_admin' => 1]);

        //check user can authedicate
        $this->actingAs($user);

        $response = $this->get('/faculty/create');
        $response->assertStatus(200);
    }

    public function test_a_super_admin_can_add_a_new_user()
    {
        $this->withoutExceptionHandling();

        //we want to create a faculty
        Faculty::create([
            'id'=> 1, 'name'=>'Faculty of Agriculture', 'facultyCode'=>'AG',
        ]);

        //we want to create a user
        $user = User::factory()->create(['is_admin' => 1]);

        //check user can authedicate
        $this->actingAs($user);

        $response = $this->post('/profile', [
            'name' => 'testUser',
            'username' => 'test',
            'email' => 'test@test.com',
            'faculty_id' => 1,
            'is_admin' => false,
            'remark' => 'this is a faculty admin',
            'password' => Hash::make('test12345'),
        ]);
        $response->assertRedirect('/profile');
    }
}
