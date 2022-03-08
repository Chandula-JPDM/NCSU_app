<?php

namespace App\Http\Controllers;

use App\Mail\ForumVerificationMail;
use Illuminate\Http\Request;

use \App\Models\Person;
use App\Models\Department;
use App\Models\Faculty;

use Image;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StaffForumController extends Controller
{
    public function create()
    {
        $faculties = Faculty::all();
        return view('forum.staff')->with('fac', $faculties);
    }

    public function store(){
        // dd(request()->all());
        
        $data = request()->validate([
            'fname' => ['required','string', 'max:20'],
            'lname' => ['required','string', 'max:20'],
            'username' => ['required','string', 'max:20', 'unique:people', 'unique:verified_data'],
            'email' => ['required', 'email:rfc,dns', 'unique:people', 'unique:verified_data'],
            'fullname' => ['required','string', 'max:100'],
            'initial' => ['required','string', 'max:50'],
            'address' => ['required','string', 'max:100'],
            'date' => ['required','string'],
            'image' => ['required','image'],
            'faculty_id' => ['required','int','exists:faculties,id'],
            'department_id' => ['required','int', 'exists:departments,id'],
            'phone' => ['required','string'],
            'post' => ['required','string'],
        ]);

        // Create the image directory if not exists
        $paths = $this->createDirectory($data['faculty_id'], 'Staff', $data['department_id']);

        // Store the image in the respective directory
        $path = $this->storeImage($paths, $data['username'], $data['image']);

        // Change the image path in the user data
        $data['image'] = $path;

        //add data to the database
        Person::create($data);

        //Mail sending procedure
        $user = $data['username'];
        Mail::to($data['email'])->queue(new ForumVerificationMail($user));

        return redirect('/forum/staff')->with('message', 'Forum data entered Succesfully!!');
    }

    public function findDepartment($id)
    {
        $dep = Department::where('faculty_id',$id)->get();
        return response()->json($dep);
    }

}
