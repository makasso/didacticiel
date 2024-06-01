<?php

namespace App\Http\Controllers\Prof;

use App\Models\Course;
use App\Models\Examen;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\ExamensAttempt;
use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //function return page dashboard
    public function dashboard()
    {
        $courses = Course::select('courses.*')
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->join('users', 'users.id', '=', 'user_course.user_id')
            ->where('user_course.user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->count();
        $examens = Examen::select('examens.*')->join('courses', 'examens.course_id', '=', 'courses.id')->join('user_course', 'courses.id', '=', 'user_course.course_id')->join('users', 'user_course.user_id', '=', 'users.id')->where('users.id', '=', Auth::id())->count();

        return view('prof.dashboard', compact('courses', 'examens'));
    }

    public function index()
    {
        $courses = Course::select([
            'courses.id',
            'courses.name',
            'courses.category_id',
            'user_course.copy_link'
            ])
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->join('users', 'users.id', '=', 'user_course.user_id')
            ->where('user_course.user_id', Auth::user()->id)
            ->orderBy('courses.id', 'DESC')
            ->get();
            

        return view('prof.course.index', compact('courses'));
    }

    public function showCourse($course_id)
    {
        $course = Course::select('courses.*')
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->join('users', 'users.id', '=', 'user_course.user_id')
            ->where('user_course.user_id', Auth::user()->id)
            ->where('courses.id', $course_id)
            ->orderBy('id', 'DESC')
            ->first();

            $slider = Slider::select(['sliders.*'])
            ->join('modules', 'modules.id', 'sliders.module_id')
            ->join('courses', 'modules.course_id', '=', 'courses.id')
            ->where(['sliders.is_introduction' => 1, 'courses.id' => $course->id])
            ->get();

        if (count($slider) == 0) {
            $slider = Slider::select(['sliders.*'])
            ->join('modules', 'modules.id', 'sliders.module_id')
            ->join('courses', 'modules.course_id', '=', 'courses.id')
            ->where(['courses.id' => $course->id])
            ->oldest()
            ->take(1);
        }        
        return view('prof.course.show', compact('course', 'slider'));
    }

    public function getModules(int $course_id)
    {
        $modules = Module::with('coursesModules')->where('course_id', $course_id)->get();

        return view('prof.module.index', compact('modules', 'course_id'));
    }

    public function showModule(int $course_id, int $module_id)
    {
        $module = Module::with(['slidersModules','coursesModules'])->where('course_id', $course_id)->where('id', $module_id)->first();

        return view('prof.module.show', compact('module'));
    }

    public function indexExamen()
    {
        $examens = Examen::select('examens.*')->join('courses', 'examens.course_id', '=', 'courses.id')->join('user_course', 'courses.id', '=', 'user_course.course_id')->join('users', 'user_course.user_id', '=', 'users.id')->where('users.id', '=', Auth::id())->get();
        $courses = Course::select('courses.*')
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->join('users', 'users.id', '=', 'user_course.user_id')
            ->where('user_course.user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('prof.examen.index', compact('examens', 'courses'));
    }

    public function getExamen(Request $request)
    {
        try {
            $examen = Examen::with('coursesExamens')->find($request->id);

            return response()->json(['success' => true, 'message' => 'Examen', 'data' => $examen]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function students(int $course_id)
    {
        $students = ExamensAttempt::with(['student', 'examen'])
            ->join('examens', 'examens_attempt.examen_id', 'examens.id')
            ->join('courses', 'examens.course_id', 'courses.id')
            ->where('status', 'is_completed')
            ->where('courses.id', $course_id)
            ->get();

        return view('prof.student.index', compact('students', 'course_id'));
    }
}
