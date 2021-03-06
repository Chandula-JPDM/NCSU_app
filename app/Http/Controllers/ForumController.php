<?php

namespace App\Http\Controllers;

use App\Mail\ForumVerificationMail;
use Illuminate\Http\Request;

use \App\Models\Employee;
use \App\Models\Person;
use App\Models\Department;
use App\Models\Batch;
use App\Models\Faculty;
use Illuminate\Support\Arr;

use Image;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForumController extends Controller
{
    public function index()
    {
        return view('forum.form');
    }
    public function create()
    {
        $faculties = Faculty::all();
        $batches = Batch::all();

        return view('forum.create')->with('fac', $faculties)->with('batch',$batches);
    }
    public function view()   //acedemic staff
    {
        $faculties = Faculty::all();
        return view('forum.staff')->with('fac', $faculties);
    }
    public function nonacc() //accdemic supporting staff
    {
        return view('forum.supStaff');
    }
    //Email verification and password setting function
    //Get method
    public function verification($username)
    {
        return view('forum.verification', compact('username'));
    }

    public function resubmission($username, Request $request)
    {
        if (! $request->hasValidSignature()) {
        abort(401);
        }

        $faculties = Faculty::all();
        $batches = Batch::all();
        $data = Person::where('username',$username)->first();

        return view('forum.resubmit')->with('fac', $faculties)->with('batch',$batches)->with('details',$data);
    }

    //updating the password field 
    public function update($username)
    {
        $data = request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['password'] = Hash::make($data['password']);
        Person::where('username',$username)->update($data);

        return redirect('/');
    }

    /**
     * Create the directory if not exists
     * @return paths
     */
    private function createDirectory($faculty_id, $type, $batch_id) {
        /**
         * chmode codes has 3 digits (Owner, Group, World)
         * Permission (4 = read only, 7 = read and write and execute)
         */
        $chmode = 744;
        
        $facultyCode = Faculty::findOrFail($faculty_id)->facultyCode;
        $tmpPath = $facultyCode.'\\'.$type.'\\'.$batch_id.'\\';

        // Define and initialize paths for different directories
        $paths = [
            'image_path' => public_path('uploads\images\\'.$tmpPath),
            'thumbnail_path' => public_path('uploads\thumbs\\'.$tmpPath)
        ];

        // Create paths
        foreach ($paths as $key => $path) {
            if(!File::isDirectory($path)){
                File::makeDirectory($path, $chmode, true, true);
            }
        }

        return $tmpPath;
    }

    /**
     * Change image name
     * Save image in respective directory
     */
    private function storeImage($path, $regNo, $file) {     
        // Create the image name
        $number = explode('/', $regNo)[2];
        // $imageName = $number.'.'.$file->getClientOriginalExtension();
        $imageName = $number.'.png';

        // Load the image, resize it and then save the profile image
        $image = Image::make($file)->fit(400, 400);
        $image->save(public_path('uploads\images\\'.$path).$imageName);

        // Resize the image and save the tumbnail
        $image->resize(150,150);
        $image->save(public_path('uploads\thumbs\\'.$path).$imageName);

        return '\uploads\images\\'.$path.$imageName;
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
            'city' => ['required','string', 'max:100'],
            'date' => ['required','string'],
            'regNo' => ['required','string', 'max:10','unique:people','unique:verified_data', 'regex:/^([A-Z]{1,2}\/{1}+\d{2}\/{1}+\d{3})/'],
            'image' => ['required','image'],
            'faculty_id' => ['required','int','exists:faculties,id'],
            'batch_id' => ['required','int','exists:batches,id'],
            'department_id' => ['required','int', 'exists:departments,id'],
        ]);

        // Create the image directory if not exists
        $paths = $this->createDirectory($data['faculty_id'], 'Student', $data['batch_id']);

        // Store the image in the respective directory
        $path = $this->storeImage($paths, $data['regNo'], $data['image']);

        // Change the image path in the user data
        $data['image'] = $path;
        Person::create($data);

        //Mail sending procedure
        Mail::to($data['email'])->send(new ForumVerificationMail());

        return redirect('/forum/create')->with('message', 'Forum data entered Succesfully!!');
    }

    public function resubmitDataStore(){
        // dd(request()->all());
        
        $data = request()->validate([
            'fname' => ['required','string', 'max:20'],
            'lname' => ['required','string', 'max:20'],
            'username' => ['required','string', 'max:20','unique:verified_data'],
            'email' => ['required', 'email:rfc,dns','unique:verified_data'],
            'fullname' => ['required','string', 'max:100'],
            'initial' => ['required','string', 'max:50'],
            'address' => ['required','string', 'max:100'],
            'city' => ['required','string', 'max:100'],
            'date' => ['required','string'],
            'regNo' => ['required','string', 'max:10','unique:verified_data', 'regex:/^([A-Z]{1,2}\/{1}+\d{2}\/{1}+\d{3})/'],
            'image' => ['image'],
            'faculty_id' => ['required','int','exists:faculties,id'],
            'batch_id' => ['required','int','exists:batches,id'],
            'department_id' => ['required','int', 'exists:departments,id'],
            // 'phone' => ['required','string'],
            // 'post' => ['required','string'],
        ]);
        // dd(Arr::exists($data, 'image'));
        $person = Person::where('email', '=', $data['email'])->where('username', '=', $data['username'])->where('isRejected', '=', true)->first();
        if ($person === null) {
        // user not found
            abort(401);
        }
        else{
            if(Arr::exists($data, 'image')){
                // Create the image directory if not exists
                $paths = $this->createDirectory($data['faculty_id'], 'Student', $data['batch_id']);

                // Store the image in the respective directory
                $path = $this->storeImage($paths, $data['regNo'], $data['image']);

                // Change the image path in the user data
                $data['image'] = $path;
            }
            else{
                $data['image'] = $person->image;
            }
            $data['isRejected'] = false;
            $person->update($data);
        }

        return redirect('/forum/create')->with('message', 'Forum data resubmitted Succesfully!!');
    }

    public function addData(){    
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
            'editor' => ['required','string'],
        ]);
        
        $data['faculty_id'] = 258;
        $data['department_id'] = 415;

        // Create the image directory if not exists
        $paths = $this->createDirectory($data['faculty_id'], 'Acc_staff', $data['department_id']);

        $imageName = $data['username'].'.png';
        // Load the image, resize it and then save the profile image
        $image = Image::make($data['image'])->fit(400, 400);
        $image->save(public_path('uploads\images\\'.$paths).$imageName);
        // Resize the image and save the tumbnail
        $image->resize(150,150);
        $image->save(public_path('uploads\thumbs\\'.$paths).$imageName);

        // Change the image path in the user data
        $data['image'] = '\uploads\images\\'.$paths.$imageName;

        //creating directory to store text file
        $facultyCode = Faculty::findOrFail($data['faculty_id'])->facultyCode;
        $tmpPath = $facultyCode.'\\'.$data['department_id'].'\\';
        // Define and initialize paths for different directories
        $txtpath = public_path('uploads\\descriptions\\'.$tmpPath);
        if(!File::isDirectory($txtpath)){
            File::makeDirectory($txtpath, 744, true, true);
        }
        $file_data = $data['editor'];
        $file_name = $data['username'].'.txt';
        File::put($txtpath.$file_name,$file_data);

        $data['editor'] = '\uploads\descriptions\\'.$tmpPath.$file_name;


        //add data to the database
        Employee::create($data);
        return redirect('/forum/staff')->with('message', 'Forum data resubmitted Succesfully!!');
    }

    public function findDepartment($id)
    {
        $dep = Department::where('faculty_id',$id)->get();
        return response()->json($dep);
    }

}