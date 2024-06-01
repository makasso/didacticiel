<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Examen;
use App\Models\Module;
use App\Models\QnaExam;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StudentModule;
use App\Models\ExamensAttempt;
use App\Models\QuestionModule;
use App\Models\ExamensAnswersFront;
use App\Http\Controllers\Controller;
use App\Models\ModulesAttempt;
use App\Models\Slider;
use App\Models\StudentExamen;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\confirm;

class FrontendController extends Controller
{
    // page examen in frontend
    public function frondtendExamen($id)
    {
        $qnaExamen = Examen::where('copy_link', $id)->with('getQnaExamens')->get();

        if (count($qnaExamen) > 0) {
            $attemptCount = ExamensAttempt::where(['examen_id' => $qnaExamen[0]['id'], 'user_id' => auth()->user()->id])->count();
            if ($attemptCount >= $qnaExamen[0]['attempt']) {
                return view('frontend.examen.index', ['success' => false, 'message' => 'Your examen attemption has been completed', 'examens' => $qnaExamen]);
            } elseif ($qnaExamen[0]['date'] == date('Y-m-d')) {
                if (count($qnaExamen[0]['getQnaExamens']) > 0) {
                    $qna = QnaExam::where('examen_id', $qnaExamen[0]['id'])
                        ->with('question', 'answers')
                        ->inRandomOrder()
                        ->get();
                    return view('frontend.examen.index', ['success' => true, 'examens' => $qnaExamen, 'qna' => $qna]);
                } else {
                    return view('frontend.examen.index', ['success' => false, 'message' => 'This examen is not available for now!', 'examens' => $qnaExamen]);
                }
            } elseif ($qnaExamen[0]['date'] > date('Y-m-d')) {
                return view('frontend.examen.index', ['success' => false, 'message' => 'This examen will be start on' . $qnaExamen[0]['date'], 'examens' => $qnaExamen]);
            } else {
                return view('frontend.examen.index', ['success' => false, 'message' => 'This examen has been expired on' . $qnaExamen[0]['date'], 'examens' => $qnaExamen]);
            }
        } else {
            return view('404');
        }
    }

    // submit examen in frontend

    public function examenSubmit(Request $request)
    {
        $exam_attempt_id = ExamensAttempt::insertGetId([
            'examen_id' => $request->examen_id,
            'user_id' => Auth::user()->id,
        ]);

        $qcount = count($request->q);

        if ($qcount > 0) {
            for ($i = 0; $i < $qcount; $i++) {
                if (!empty($request->input('ans_' . ($i + 1)))) {
                    # code...

                    ExamensAnswersFront::insert([
                        'exam_attempt_id' => $exam_attempt_id,
                        'question_id' => $request->q[$i],
                        'answer_id' => request()->input('ans_' . ($i + 1)),
                    ]);
                }
            }
        }

        return view('thank-you');
    }

    // frontend course
    public function frondtendCourse($copy_link)
    {
        $course = Course::select(['courses.*', 'user_course.copy_link'])
            ->with(['modulesCourses', 'categoriesCourses', 'user'])
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where('user_course.copy_link', $copy_link)
            ->first();

        if (!StudentModule::where('student_id', Auth::id())->first()) {
            foreach ($course->modulesCourses as $module) {
                StudentModule::create([
                    'student_id' => Auth::id(),
                    'module_id' => $module->id,
                    'is_completed' => 0,
                ]);
            }
        }

        $student_modules = StudentModule::where('student_id', Auth::id())->get();

        $count_modules = \App\Models\StudentModule::select('student_module.*')
            ->join('modules', 'student_module.module_id', 'modules.id')
            ->join('courses', 'modules.course_id', 'courses.id')
            ->where(['student_module.student_id' => Auth::id(), 'courses.copy_link' => $copy_link])
            ->count();

        $completed_modules = \App\Models\StudentModule::select('student_module.*')
            ->join('modules', 'student_module.module_id', 'modules.id')
            ->join('courses', 'modules.course_id', 'courses.id')
            ->where(['student_module.student_id' => Auth::id(), 'student_module.is_completed' => 1, 'courses.copy_link' => $copy_link])
            ->count();

        $completion_percentage = $completed_modules > 0 ? ($completed_modules * 100) / $count_modules : 0;

        $slider = Slider::select(['sliders.*'])
            ->join('modules', 'modules.id', 'sliders.module_id')
            ->join('courses', 'modules.course_id', '=', 'courses.id')
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where(['sliders.is_introduction' => 1, 'user_course.copy_link' => $copy_link])
            ->get();

        if (count($slider) == 0) {
            $slider = Slider::select(['sliders.*'])
            ->join('modules', 'modules.id', 'sliders.module_id')
            ->join('courses', 'modules.course_id', '=', 'courses.id')
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where(['user_course.copy_link' => $copy_link])
            ->oldest()
            ->take(1);
        }    

        if ($course) {
            return view('frontend.course.index', compact('course', 'student_modules', 'completion_percentage', 'count_modules', 'completed_modules', 'slider'));
        }
        return abort('404');
    }

    public function frontendModule($copy_link, $module_id)
    {
        $module = Module::with(['slidersModules', 'coursesModules'])
            ->select('modules.*')
            ->join('courses', 'modules.course_id', '=', 'courses.id')
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where(['modules.id' => $module_id, 'user_course.copy_link' => $copy_link])
            ->first();

        $course = Course::select(['courses.*', 'user_course.copy_link'])
            ->with(['modulesCourses', 'categoriesCourses', 'user'])
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where('user_course.copy_link', $copy_link)
            ->first();

        if (StudentModule::where('module_id', '<', $module_id)->where('is_completed', '=', 0)->where('student_id', '=', Auth::id())->orderBy('module_id', 'desc')->first()) {
            abort('403');
        }

        $count_modules = \App\Models\StudentModule::select('student_module.*')
            ->join('modules', 'student_module.module_id', 'modules.id')
            ->join('courses', 'modules.course_id', 'courses.id')
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where(['student_module.student_id' => Auth::id(), 'user_course.copy_link' => $copy_link])
            ->count();

        $completed_modules = \App\Models\StudentModule::select('student_module.*')
            ->join('modules', 'student_module.module_id', 'modules.id')
            ->join('courses', 'modules.course_id', 'courses.id')
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where(['student_module.student_id' => Auth::id(), 'student_module.is_completed' => 1, 'user_course.copy_link' => $copy_link])
            ->count();

        $completion_percentage = $completed_modules > 0 ? ($completed_modules * 100) / $count_modules : 0;

        $countModuleAttempts = ModulesAttempt::where([
            'module_id' => $module_id,
            'student_id' => Auth::id(),
        ])->count();

        $questions = QuestionModule::with('answers')->join('qna_modules', 'question_modules.id', 'qna_modules.question_id')->join('modules', 'qna_modules.module_id', 'modules.id')->where('module_id', $module_id)->get()->toArray();

        if ($module) {
            return view('frontend.module.index', compact('module', 'completion_percentage', 'course', 'countModuleAttempts', 'questions'));
        }

        abort('404');
    }

    public function completeModule($module_id)
    {
        return redirect()->back()->withToastSuccess('Félicitations vous avez terminé ce module!');
    }

    public function frontendModuleQuiz($copy_link, $module_id)
    {
        $module = Module::with('coursesModules')->where('id', $module_id)->first();
        $questions = QuestionModule::with('answers')->join('qna_modules', 'question_modules.id', 'qna_modules.question_id')->join('modules', 'qna_modules.module_id', 'modules.id')->where('module_id', $module_id)->get()->toArray();

        $countModuleAttempts = ModulesAttempt::where([
            'module_id' => $module_id,
            'student_id' => Auth::id(),
        ])->count();

        return view('frontend.quiz.index', compact('module', 'questions', 'countModuleAttempts'));
    }

    public function getQuiz($module_id)
    {
        $questions = QuestionModule::with('answers')->select('question_modules.*')->join('qna_modules', 'question_modules.id', 'qna_modules.question_id')->join('modules', 'qna_modules.module_id', 'modules.id')->where('modules.id', $module_id)->inRandomOrder()->get()->toArray();

        $newQuestions = [];
        $index = 1;

        foreach ($questions as $q) {
            $newQuestions[$index] = $q;
            $index++;
        }

        return response()->json(['success' => true, 'data' => $newQuestions]);
    }

    public function completeQuiz(Request $request, $module_id)
    {
        ModulesAttempt::create([
            'module_id' => $module_id,
            'student_id' => Auth::id(),
            'marks' => $request->marks,
        ]);

        $countModuleAttempts = ModulesAttempt::where([
            'module_id' => $module_id,
            'student_id' => Auth::id(),
        ])->count();

        $attemptsLeft = 2 - $countModuleAttempts;

        StudentModule::where(['module_id' => $module_id, 'student_id' => Auth::id()])->update(['is_completed' => 1]);

        return redirect()
            ->back()
            ->withToastSuccess('Félicitations vous avez passé un quiz, vous pouvez désormais passer au module suivant!' . PHP_EOL . 'Il vous reste ' . $attemptsLeft . ' essais');
    }

    public function passExamen($copy_link)
    {
        $course = Course::select(['courses.*', 'user_course.copy_link'])
            ->with(['modulesCourses', 'categoriesCourses', 'user'])
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where('user_course.copy_link', $copy_link)
            ->first();
        if (Examen::where('course_id', $course->id)->exists()) {
            $examen = Examen::where('course_id', $course->id)->pluck('id')->random();
        } else {
            return redirect()->back()->withToastError('Pas encore d\'examen pour ce cours!');
        }    
               if (
            ExamensAttempt::join('examens', 'examens_attempt.examen_id', 'examens.id')
                ->join('courses', 'examens.course_id', 'courses.id')
                ->where(['student_id' => Auth::id(), 'courses.id' => $course->id, 'is_completed' => 1])
                ->exists()
        ) {
            return redirect()->back()->withToastError('Vous avez déjà passé un examen pour ce cours!');
        }

        $questions = QuestionModule::with('answers')
            ->select('question_modules.*')
            ->join('qna_exams', 'question_modules.id', 'qna_exams.question_id')
            ->join('examens', 'qna_exams.examen_id', 'examens.id')
            ->join('courses', 'examens.course_id', 'courses.id')
            ->where(['examens.id' => $examen])
            ->get()
            ->toArray();

        return view('frontend.examen.index', compact('course', 'questions', 'examen'));
    }

    public function getExamen(Request $request, $copy_link)
    {
        $course = Course::select(['courses.*', 'user_course.copy_link'])
            ->with(['modulesCourses', 'categoriesCourses', 'user'])
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where('user_course.copy_link', $copy_link)
            ->first();

        $questions = QuestionModule::with('answers')
            ->select('question_modules.*')
            ->join('qna_exams', 'question_modules.id', 'qna_exams.question_id')
            ->join('examens', 'qna_exams.examen_id', 'examens.id')
            ->join('courses', 'examens.course_id', 'courses.id')
            ->where(['examens.id' => $request->examen_id])
            ->inRandomOrder()
            ->get()
            ->toArray();
        $newQuestions = [];
        $index = 1;

        foreach ($questions as $q) {
            $newQuestions[$index] = $q;
            $index++;
        }

        return response()->json(['success' => true, 'data' => $newQuestions]);
    }

    public function completeExamen(Request $request, $copy_link)
    {
        $examen_attempt = ExamensAttempt::create([
            'examen_id' => $request->examen_id,
            'student_id' => Auth::id(),
            'marks' => $request->marks,
        ]);

        $student = Student::find(Auth::id());
        $course = Course::select(['courses.*', 'user_course.copy_link'])
            ->with(['modulesCourses', 'categoriesCourses', 'user'])
            ->join('user_course', 'courses.id', '=', 'user_course.course_id')
            ->where('user_course.copy_link', $copy_link)
            ->first();
        $examen = Examen::find($request->examen_id);

        $percentage = ((int) $request->marks * 100) / $request->number_questions;

        if ($percentage >= 70) {
            $examen_attempt_certificate = date('Ymd') . Str::random(14);
            ExamensAttempt::where('id', $examen_attempt->id)->update([
                'is_completed' => 1,
                'certificate_id' => $examen_attempt_certificate,
            ]);

            return view('frontend.examen.result', compact('student', 'course', 'percentage', 'examen', 'examen_attempt_certificate'));
        }
        return view('frontend.examen.result', compact('student', 'course', 'percentage', 'examen'));
    }

    public function generateCertificate($examen_id, $student_id, $certificate_id)
    {
        $examen = Examen::find($examen_id);
        $course = Course::with('user')
            ->where('id', $examen->course_id)
            ->first();
        $student = Student::find($student_id);

        $pdf = \PDF::loadView('certficate.index', compact('examen', 'course', 'student', 'certificate_id'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download(uniqid('certificat') . '.pdf');
    }

    public function updateProfileStudent(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
        ]);

        $student = Student::where('id', '=', auth()->id())->first();
        $student->name = $request->name;
        $student->save();

        return redirect()->back()->withToastSuccess('Votre profil a été mis à jour avec succès');
    }

    public function editProfile()
    {
        return view('profile.student.edit');
    }

    public function dashboard()
    {
        return view('frontend.dashboard', compact('course'));
    }
}
