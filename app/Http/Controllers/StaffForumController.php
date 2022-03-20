<?php

namespace App\Http\Controllers;

use App\Mail\ForumVerificationMail;
use Illuminate\Http\Request;

use \App\Models\Employee;
use App\Models\Department;
use App\Models\Faculty;

use Image;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StaffForumController extends Controller
{
    public function index()
    {
        return view('forum.supStaff');
    }
    public function view()
    {
        $faculties = Faculty::all();
        return view('forum.staff')->with('fac', $faculties);
    }
    
    public function addData(Request $request){
        // dd(request()->all());
    
        $data = request()->validate([
            'fname' => ['required','string', 'max:20'],
            'lname' => ['required','string', 'max:20'],
            'username' => ['required','string', 'max:20', 'unique:people', 'unique:verified_data'],
            'email' => ['required', 'email:rfc,dns', 'unique:people', 'unique:verified_data'],
            'fullname' => ['required','string', 'max:100'],
            'initial' => ['required','string', 'max:50'],
            'address' => ['required','string', 'max:100'],
            'image' => ['required','image'],
            //'faculty_id' => ['required','int','exists:faculties,id'],
            //'department_id' => ['required','int', 'exists:departments,id'],
            'phone' => ['required','string'],
            'post' => ['required','string'],
        ]);

        // Create the image directory if not exists
        //$paths = $this->createDirectory($data['faculty_id'], 'Staff', $data['department_id']);

        // Store the image in the respective directory
        //$path = $this->storeImage($paths, $data['username'], $data['image']);

        // Change the image path in the user data
        //$data['image'] = $path;
        $data['image'] = 'path1';
        $data['faculty_id'] = 258;
        $data['department_id'] = 415;
        
        //add data to the database
        Employee::create($data);
        return back()->with('success', 'Your form has been submitted.');
    }


}
