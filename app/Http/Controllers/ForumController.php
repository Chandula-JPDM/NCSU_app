<?php

namespace App\Http\Controllers;

use App\Mail\ForumVerificationMail;
use Illuminate\Http\Request;

use \App\Models\Person;
use App\Models\Department;
use App\Models\Batch;
use App\Models\Faculty;

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
    public function staff()
    {
        return view('forum.staff');
    }

    public function create()
    {
        $faculties = Faculty::all();
        $batches = Batch::all();

        return view('forum.create')->with('fac', $faculties)->with('batch',$batches);
    }

    //Email verification and password setting function
    //Get method
    public function verification($username)
    {
        return view('forum.verification', compact('username'));
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
        // $tmpPath = $facultyCode.'/'.$type.'/'.$batch_id.'/';
        $tmpPath = $facultyCode.'\\'.$type.'\\'.$batch_id.'\\';

        // Define and initialize paths for different directories
        $paths = [
            // 'image_path' => public_path('uploads/images/'.$tmpPath),
            // 'thumbnail_path' => public_path('uploads/thumbs/'.$tmpPath)
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
        // $image->save(public_path('uploads/images/'.$path).$imageName);

        // Resize the image and save the tumbnail
        $image->resize(150,150);
        $image->save(public_path('uploads\thumbs\\'.$path).$imageName);
        // $image->save(public_path('uploads/thumbs/'.$path).$imageName);

        return '\uploads\images\\'.$path.$imageName;
        // return '/uploads/images/'.$path.$imageName;
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

        //add data to the database
        Person::create($data);

        //Mail sending procedure
        $user = $data['username'];
        Mail::to($data['email'])->queue(new ForumVerificationMail($user));

        return redirect('/forum/create')->with('message', 'Forum data entered Succesfully!!');
    }

    public function findDepartment($id)
    {
        $dep = Department::where('faculty_id',$id)->get();
        return response()->json($dep);
    }

}
