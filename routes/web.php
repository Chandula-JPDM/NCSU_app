<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth:administration');

Route::get('/catalogue', [App\Http\Controllers\catalogueController::class, 'index'])->name('catalogue.index');
Route::get('/catalogue/{facCode}', [App\Http\Controllers\catalogueController::class, 'getBatches'])->name('catalogue.getBatches');
Route::get('/catalogue/{facCode}/{batch}', [App\Http\Controllers\catalogueController::class, 'getStudents'])->name('catalogue.getStudents');

Route::get('/forum/create', [App\Http\Controllers\ForumController::class, 'create']);

Route::get('/forum/create/{id}', [App\Http\Controllers\ForumController::class, 'findDepartment']);

Route::get('/forum/form', [App\Http\Controllers\ForumController::class, 'index']);
Route::get('/forum/staff', [App\Http\Controllers\StaffForumController::class, 'create']);
// Route::post('/forum/staff', [App\Http\Controllers\StaffForumController::class, 'store'])->name('forum.store');

Route::post('/forum', [App\Http\Controllers\ForumController::class, 'store'])->name('forum.store');

Route::get('/uop/{username}', [App\Http\Controllers\catalogueController::class, 'getProfile']);

Route::get('/forum/{username}/register', [App\Http\Controllers\ForumController::class, 'verification'])->name('forum.verification');

Route::put('/forum/{username}', [App\Http\Controllers\ForumController::class, 'update'])->name('forum.update');

// Route that can be only accesed by the super admin
Route::group(['middleware' => ['auth:administration', 'super.admin']], function () {
    // your routes
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');

    Route::get('/profile/create', [App\Http\Controllers\ProfileController::class, 'create']);

    Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.destroy');

    Route::post('/faculty', [App\Http\Controllers\FacultyController::class, 'store'])->name('faculty.store');

    Route::get('/faculty/create', [App\Http\Controllers\FacultyController::class, 'create']);
});

//Route that can be only accesed by the faculty admins
Route::group(['middleware' => ['auth:administration', 'admin']], function () {
    
    Route::get('/person/{batch}', [App\Http\Controllers\PersonController::class, 'index'])->name('person.index');

    Route::get('/person/{batch}/{person}', [App\Http\Controllers\PersonController::class, 'profile']);

    Route::get('/person/{batch}/{person}/verify', [App\Http\Controllers\PersonController::class, 'verify']);
});
