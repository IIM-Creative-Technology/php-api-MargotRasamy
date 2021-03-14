<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Promotion;
use \App\Models\Teacher;
use \App\Models\Student;
use \App\Models\Course;
use \App\Models\Score;
use \App\Http\Controllers\AuthController;
use \Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//PS: Sorry. Didn't have quite the time to organize in routes in controllers.

Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('jwt.auth')->group(function () {

    // PROMOTIONS
    // READ
    Route::get('/promotions', function () {
        return Promotion::all();
    });
    Route::get('/promotions/{promotionId}', function ($promotionId) {
        return Promotion::findOrFail($promotionId);
    });
    // CREATE parameters: 'name','year'
    Route::post('/promotions', function (Request $request) {
        return (Promotion::create($request->all()));
    });
    // UPDATE
    Route::put('/promotions/{promotionId}', function ($promotionId, Request $request) {
        $promotion = Promotion::findOrFail($promotionId);
        $promotion->update($request->all());
        return $promotion;
    });
    // DELETE
    Route::delete('/promotions/{promotionId}', function ($promotionId) {
        Promotion::findOrFail($promotionId)->delete();
        return response()->json('Successfully deleted the promotion !');
    });


    //TEACHERS
    // READ
    Route::get('/teachers', function () {
        return Teacher::all();
    });
    Route::get('/teachers/{id}', function ($id) {
        return Teacher::findOrFail($id);
    });
    // CREATE parameters 'firstname','lastname','arrival_year',
    Route::post('/teachers', function (Request $request) {
        return (Teacher::create($request->all()));
    });
    // UPDATE
    Route::put('/teachers/{id}', function ($id, Request $request) {
        $teachers = Teacher::findOrFail($id);
        $teachers->update($request->all());
        return $teachers;
    });
    // DELETE
    Route::delete('/teachers/{id}', function ($id) {
        Teacher::findOrFail($id)->delete();
        return response()->json('The teacher left his position at IIM !');
    });

    //STUDENTS
    // READ
    Route::get('/students', function () {
        return Student::all();
    });
    Route::get('/students/{id}', function ($id) {
        return Student::findOrFail($id);
    });
    // List of students by promotion name : http://127.0.0.1:8000/api/students?promotionName=A6
    Route::get('/students', function (Request $request) {
        $promotionId = $request->query('promotionId');
        $promotionName = $request->query('promotionName');
        if ($promotionName) {
            return DB::table('students')
                ->join('promotions', 'students.promotion_id', '=', 'promotions.id')
                ->where('promotions.name', $promotionName)
                ->select(
                    'students.firstname',
                    'students.lastname',
                    'students.promotion_name',
                    'students.promotion_id',
                    'students.age')
                ->get();
        }
        if ($promotionId) {
            return DB::table('students')
                ->join('promotions', 'students.promotion_id', '=', 'promotions.id')
                ->where('promotions.id', $promotionId)
                ->select(
                    'students.firstname',
                    'students.lastname',
                    'students.promotion_name',
                    'students.promotion_id',
                    'students.age')
                ->get();
        }
        return 'Please send your promotion name or promotion id in the query parameters.';
    });
    // CREATE parameters : 'firstname','lastname','age','arrival_year','promotion_id'
    Route::post('/students', function (Request $request) {
        $promotionName = DB::table('promotions')
            ->where('promotions.id', $request->promotion_id)
            ->select(
                'promotions.name')
            ->get();
        $student = new Student(($request->all()));
        $student->promotion_name = $promotionName[0]->name;
        $student->save();
        return $student;
    });
    // UPDATE
    Route::put('/students/{id}', function ($id, Request $request) {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        if ($request->promotion_id) {
            $promotionName = DB::table('promotions')
                ->where('promotions.id', $request->promotion_id)
                ->select('promotions.name')
                ->get();
            $student->promotion_name = $promotionName[0]->name;
        }
        $student->save();
        return $student;
    });
    // DELETE
    Route::delete('/students/{id}', function ($id) {
        Student::findOrFail($id)->delete();
        return response()->json('The student has quit IIM !');
    });

    //COURSES
    // READ
    Route::get('/courses', function () {
        return Course::all();
    });
    Route::get('/courses/{id}', function ($id) {
        return Course::findOrFail($id);
    });
    // CREATE parameters 'name','start_at','end_at','promotion_id','teacher_id'
    Route::post('/courses', function (Request $request) {
        $promotionName = DB::table('promotions')
            ->where('promotions.id', $request->promotion_id)
            ->select(
                'promotions.name')
            ->get();
        $teacherFirstname = DB::table('teachers')
            ->where('teachers.id', $request->teacher_id)
            ->select(
                'teachers.firstname')
            ->get();
        $teacherLastname = DB::table('teachers')
            ->where('teachers.id', $request->teacher_id)
            ->select(
                'teachers.lastname')
            ->get();
        $course = new Course(($request->all()));
        $course->promotion_name = $promotionName[0]->name;
        $course->teacher_name = $teacherFirstname[0]->firstname . ' ' . $teacherLastname[0]->lastname;
        $course->save();
        return $course;
    });
    // UPDATE
    Route::put('/courses/{id}', function ($id, Request $request) {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        if ($request->promotion_id) {
            $promotionName = DB::table('promotions')
                ->where('promotions.id', $request->promotion_id)
                ->select('promotions.name')
                ->get();
            $course->promotion_name = $promotionName[0]->name;
        }
        if ($request->teacher_id) {
            $teacherFirstname = DB::table('teachers')
                ->where('teachers.id', $request->teacher_id)
                ->select('teachers.firstname')
                ->get();
            $teacherLastname = DB::table('teachers')
                ->where('teachers.id', $request->teacher_id)
                ->select('teachers.lastname')
                ->get();
            $course->teacher_name = $teacherFirstname[0]->firstname . ' ' . $teacherLastname[0]->lastname;
        }
        $course->save();
        return $course;
    });
    // DELETE
    Route::delete('/courses/{id}', function ($id) {
        Course::findOrFail($id)->delete();
        return response()->json('This course is no longer given or available at IIM !');
    });

    //SCORES
    // READ
    Route::get('/scores', function () {
        return Score::all();
    });

    Route::get('/scores', function (Request $request) {
        $student = DB::table('students')
            ->where('students.id', $request->query('studentId'))
            ->get();
        if (!isset($student)) {
            return "Sorry but this student doesn't exist at IIM";
        }
        if ($request->query('courseId')) {
            $score = DB::table('scores')
                ->where('scores.student_id', $request->query('studentId'))
                ->where('scores.course_id', $request->query('courseId'))
                ->get();
            if (count($score)== 0) {
                return "This student has no score yet in this course. You can add his/her score.";
            }
            return $score;
        }
        $score = DB::table('scores')
            ->where('scores.student_id', $request->query('studentId'))
            ->get();
        if (count($score)== 0) {
            return "This student has no score yet. You can add his/her score.";
        }
        return $score;
    });

    // CREATE POST parameters score, student_id, course_id
    Route::post('/scores', function (Request $request) {
        $courseName = DB::table('courses')
            ->where('courses.id', $request->course_id)
            ->select('courses.name')
            ->get();
        $studentFirstname = DB::table('students')
            ->where('students.id', $request->student_id)
            ->select(
                'students.firstname')
            ->get();
        $studentLastname = DB::table('students')
            ->where('students.id', $request->student_id)
            ->select(
                'students.lastname')
            ->get();

        $score = new Score(($request->all()));
        $score->course_name = $courseName[0]->name;
        $score->student_name = $studentFirstname[0]->firstname . ' ' . $studentLastname[0]->lastname;
        $score->save();
        return $score;
    });
});
