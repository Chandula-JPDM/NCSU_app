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

Route::get('/uop/{username}', [App\Http\Controllers\catalogueController::class, 'getProfile']);

// Route that can be only accesed by the super admin
Route::group(['middleware' => ['auth:administration', 'super.admin']], function() {
    // your routes
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');

    Route::get('/profile/create', [App\Http\Controllers\ProfileController::class, 'create']);

    Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.destroy');

    Route::post('/faculty', [App\Http\Controllers\FacultyController::class, 'store'])->name('faculty.store');

    Route::get('/faculty/create', [App\Http\Controllers\FacultyController::class, 'create']);
});

// Routes for the site activity logging
Route::group(['prefix' => 'activity', 'namespace' => 'App\Http\Controllers', 'middleware' => ['super.admin', 'auth:administration', 'activity']], function () {

    // Dashboards
    Route::get('/', 'LaravelLoggerController@showAccessLog')->name('activity');
    Route::get('/cleared', ['uses' => 'LaravelLoggerController@showClearedActivityLog'])->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', 'LaravelLoggerController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', 'LaravelLoggerController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', ['uses' => 'LaravelLoggerController@clearActivityLog'])->name('clear-activity');
    Route::delete('/destroy-activity', ['uses' => 'LaravelLoggerController@destroyActivityLog'])->name('destroy-activity');
    Route::post('/restore-log', ['uses' => 'LaravelLoggerController@restoreClearedActivityLog'])->name('restore-activity');
});

// Routes for verification by admins
Route::group(['prefix' => 'person/{batch}','middleware' => ['auth:administration','admin']], function () {

    Route::get('/', [App\Http\Controllers\PersonController::class, 'index'])->name('person.index');
    Route::get('/{person}', [App\Http\Controllers\PersonController::class, 'profile']);
    Route::get('/{person}/verify', [App\Http\Controllers\PersonController::class, 'verify']);
    Route::post('/{person}/reject', [App\Http\Controllers\PersonController::class, 'reject']);
});

// Routes for the catalogue views
Route::group(['prefix' => 'catalogue'], function () {

    Route::get('/', [App\Http\Controllers\catalogueController::class, 'index'])->name('catalogue.index');
    Route::get('/{facCode}', [App\Http\Controllers\catalogueController::class, 'getBatches'])->name('catalogue.getBatches');
    Route::get('/{facCode}/{batch}', [App\Http\Controllers\catalogueController::class, 'getStudents'])->name('catalogue.getStudents');
});

Route::group(['prefix' => 'forum'], function () {

    Route::get('/create', [App\Http\Controllers\ForumController::class, 'create']);
    Route::get('/create/{id}', [App\Http\Controllers\ForumController::class, 'findDepartment']);
    Route::get('/form', [App\Http\Controllers\ForumController::class, 'index']);
    Route::get('/staff', [App\Http\Controllers\StaffForumController::class, 'create']);
    Route::post('/staff', [App\Http\Controllers\StaffForumController::class, 'store'])->name('forum.store');
    Route::post('/', [App\Http\Controllers\ForumController::class, 'store'])->name('forum.store');
    Route::get('/{username}/register', [App\Http\Controllers\ForumController::class, 'verification'])->name('forum.verification');
    Route::put('/{username}', [App\Http\Controllers\ForumController::class, 'update'])->name('forum.update');
    Route::get('/resubmit/{username}', [App\Http\Controllers\ForumController::class, 'resubmission'])->name('forum.resubmit');
    Route::post('/resubmission', [App\Http\Controllers\ForumController::class, 'resubmitDataStore'])->name('forum.restore');
});
