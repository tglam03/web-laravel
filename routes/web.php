<?php

    use App\Http\Controllers\CourseController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    Route::get('/', function () {
        return view('welcome');
    });
    Route::resource('courses', CourseController::class)->except(['show']);

//    Route::get('/courses/api', [CourseController::class, 'api'])->name('courses.api');

//    Route::get('courses/api',  [CourseController::class, 'api'])->name('courses.api');


    Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');
    Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('courses.api.name');


    Route::get('test', function () {
        return view('admin.master');
    });



