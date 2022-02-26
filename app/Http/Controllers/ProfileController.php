<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $current_date_time = Carbon::now()->toDateTimeString();

        $id = $user->id;
        $user->lastOnline = $current_date_time;
        $user->update();

        // $users = DB::table('users')->get();
        $users = User::all();

        $batch = \App\Models\Batch::all();

        $faculty = \App\Models\faculty::all();

        $department = \App\Models\Department::all();

        // $batch1 = collect($batch);
        $people = DB::table('people')->where('faculty_id', $user->faculty_id)->get()->countby('batch_id');

        // dd($people);

        $colle = collect([
            '16' => 0,
            '17' => 0,
            '18' => 0,
            '19' => 0,
            '20' => 0,
        ]);

        //$diff = $colle->diffKeys($people);
        $people = $people->union($colle);

        //dd($colle);
        return view('home')->with('name', $users)->with('faculty', $faculty)->with('user', $user)->with('batch', $batch)->with('people', $people);
    }

    public function create()
    {
        $faculties = DB::table('faculties')->get();

        return view('profile.create')->with('faculty', $faculties);
    }

    public function delete(User $user)
    {
        $deleted = DB::table('users')->where('id', '=', $user->id)->delete();

        return redirect('/profile');
    }

    public function store()
    {

        // dd(request()->all());
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'faculty_id' => ['required', 'int', 'exists:faculties,id'],
            'is_admin' =>['required', 'boolean'],
            'remark' => ['string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'faculty_id' => $data['faculty_id'],
            'is_admin' => $data['is_admin'],
            'remark' => $data['remark'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect('/profile');
    }
}
