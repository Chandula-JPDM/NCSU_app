<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Department;
use App\Models\faculty;
use App\Models\verifiedData;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class catalogueController extends Controller
{
    //
    public function index()
    {
        $faculty = new faculty();
        $faculties = $faculty::all();
        // dd($faculties);
        return view('catalogue.catalogue')->with('fac', $faculties);
    }

    // this function gives the batches of a faculty
    public function getBatches($facCode)
    {
        $faculty = new faculty();
        $fac_name = $faculty::where('facultyCode', $facCode)->firstorFail()->name;

        $batch = new Batch();
        $batches = $batch::all();

        return view('catalogue.batch')->with('facultyCode', $facCode)->with('facultyname', $fac_name)->with('batches', $batches);
    }

    // this function gives the students of a batch of a faculty
    public function getStudents($facCode, $batch)
    {
        //dd($fac);
        $faculty = new faculty();
        $fac_id = $faculty::where('facultyCode', $facCode)->firstorFail()->id;
        $fac_name = $faculty::where('facultyCode', $facCode)->firstorFail()->name;
        //dd($fac_id);

        $person = new verifiedData();
        $people = $person::select('image', 'fullname', 'regNo', 'username')->where('faculty_id', $fac_id)->where('batch_id', $batch)->orderBy('regNo', 'asc')->get();

        // Change the image url to pick its respective thumbnails
        foreach ($people as $key => $person) {
            $image_link = explode('\\', $person->image);
            $image_link[2] = 'thumbs';
            $person->image = implode('/', $image_link);
        }

        // dd($students);
        return view('catalogue.student')->with('facultyCode', $facCode)->with('people', $people)->with('batch', $batch)->with('facultyname', $fac_name);
    }

    //  ## this function is not used!!!
    // public function getDetails($facCode, $batch, $regno)
    // {
    //     //dd($fac);
    //     $faculty = new faculty();
    //     $fac_name = $faculty::where('facultyCode', $facCode)->firstorFail()->name;
    //     $fac_id = $faculty::where('facultyCode', $facCode)->firstorFail()->id;
    //     //dd($fac_id);

    //     $no = "E/16/".Str::afterLast($regno,'/');
    //     //dd($no);
    //     $person = new verifiedData();
    //     $studentDetails = $person::where('faculty_id', $fac_id)->where('regNo','=', $no)->firstorFail();

    //     $department = new Department();
    //     //$depid = $studentDetails->department_id;
    //     $dep_name = $department::where('faculty_id', $fac_id)->where('id', $studentDetails->department_id)->firstorFail()->name;
    //     //dd($studentDetails);
    //     return view('catalogue.details')->with('details', $studentDetails)->with('facName', $fac_name)->with('depName', $dep_name)->with('facultyCode', $facCode)->with('batch', $batch);

    // }

    public function getProfile($username)
    {

        // dd($username);
        $studentDetails = verifiedData::where('username', $username)->firstorFail();

        $dep_name = $studentDetails->department->name;
        $fac_name = $studentDetails->faculty->name;
        $facCode = $studentDetails->faculty->facultyCode;
        $batch = $studentDetails->batch->id;

        // dd($studentDetails);
        return view('catalogue.details')->with('details', $studentDetails)->with('facName', $fac_name)->with('depName', $dep_name)->with('facultyCode', $facCode)->with('batch', $batch);
    }
}
