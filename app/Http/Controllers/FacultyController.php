<?php

namespace App\Http\Controllers;

use App\Models\faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function create()
    {
        return view('faculty.create');
    }

    public function store()
    {

        // dd(request()->all());

        $data = request()->validate([
            'id' => ['required', 'int', 'unique:faculties'],
            'name' => ['required', 'string', 'max:255', 'unique:faculties'],
            'facultyCode' => ['required', 'string', 'max:5', 'unique:faculties'],
            'remark' => ['required', 'string', 'max:100'],
        ]);

        faculty::create($data);

        return redirect()->back()->with('message', 'New faculty added to the database Succesfully!!');
    }
}
