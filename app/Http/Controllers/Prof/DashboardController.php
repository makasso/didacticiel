<?php

namespace App\Http\Controllers\Prof;

use App\Models\Course;
use App\Models\Examen;
use Illuminate\Http\Request;
use App\Models\ExamensAttempt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //function return page dashboard
    public function dashboard()
    {
        // $courses = Course::with('categoriesCourses')->orderBy('id')->get();
        $courses = Course::with('categoriesCourses')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->count();
        $examens = Examen::orderBy('id', 'DESC')->count();

        return view('prof.dashboard', compact('courses', 'examens'));
    }

    public function index()
    {
        $courses = Course::select('courses.*')
        ->join('user_course', 'courses.id', '=', 'user_course.course_id')
        ->join('users', 'users.id', '=', 'user_course.user_id')
        ->where('user_course.user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('prof.course.index', compact('courses'));
    }

    public function indexExamen()
    {
        $examens = Examen::orderBy('id', 'DESC')->get();
        $courses = Course::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('prof.examen.index', compact('examens', 'courses'));
    }

    public function students(int $course_id)
    {
        $students = ExamensAttempt::with(['student', 'examen'])
                        ->join('examens', 'examens_attempt.examen_id', 'examens.id')
                        ->join('courses', 'examens.course_id', 'courses.id')
                        ->where('status', 'is_completed')
                        ->where('courses.id', $course_id)
                        ->get();

        return view('prof.student.index', compact('students'));
    }
}
