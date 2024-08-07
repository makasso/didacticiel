<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Examen;
use App\Models\ExamensAttempt;
use App\Models\Module;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
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
        $module = Module::with(['slidersModules', 'coursesModules'])->where('course_id', $course_id)->where('id', $module_id)->first();

        return view('prof.module.show', compact('module'));
    }

    public function getSliders()
    {
        $sliders = Slider::select('sliders.*')->join('modules', 'sliders.module_id', 'modules.id')
            ->join('courses', 'modules.course_id', 'courses.id')
            ->join('user_course', 'courses.id', 'user_course.course_id')
            ->join('users', 'user_course.user_id', 'users.id')
            ->where('user_course.user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('prof.slider.index', compact('sliders'));
    }

    public function showSlider(int $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);

        return view('prof.slider.show', compact('slider'));
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
        } catch (Exception $e) {
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

    public function exportCSV(int $course_id)
    {
        $fileName = 'étudiants.csv';
        $students = ExamensAttempt::with(['student', 'examen'])
            ->join('examens', 'examens_attempt.examen_id', 'examens.id')
            ->join('courses', 'examens.course_id', 'courses.id')
            ->where('status', 'is_completed')
            ->where('courses.id', $course_id)
            ->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Nom', 'Prénom', 'Email', 'Date de complétion', 'Statut');

        $callback = function() use($students, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, chr(0xEF). chr(0xBB) . chr(0xBF));
            fputcsv($file, $columns);

            foreach ($students as $student) {
                $row['Nom']    = $student->student->lastname;
                $row['Prénom']    = $student->student->firstname;
                $row['Email']  = $student->student->email;
                $row['Date de complétion']  = $student->student->created_at->format('d-m-Y');
                $row['Statut']  = $student->is_completed == 1 ? 'Terminé' : 'En cours';

                fputcsv($file, array($row['Nom'], $row['Prénom'], $row['Email'], $row['Date de complétion'], $row['Statut']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
