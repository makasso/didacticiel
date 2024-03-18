<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Examen;
use App\Models\QnaExam;
use Illuminate\Http\Request;
use App\Models\ExamensAttempt;
use App\Models\ExamensAnswersFront;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    // page examen in frontend
    public function frondtendExamen($id)
    {
        $qnaExamen = Examen::where('copy_link',$id)->with('getQnaExamens')->get();

        if (count($qnaExamen) > 0) {

            $attemptCount = ExamensAttempt::where(['examen_id'=>$qnaExamen[0]['id'], 'user_id'=>auth()->user()->id])->count();
            if ($attemptCount >= $qnaExamen[0]['attempt']) {
                return view('frontend.examen.index', ['success'=>false, 'message'=>'Your examen attemption has been completed', 'examens'=>$qnaExamen]);
            }
            else if ($qnaExamen[0]['date'] == date('Y-m-d')) {

                if (count($qnaExamen[0]['getQnaExamens']) > 0) {

                    $qna = QnaExam::where('examen_id', $qnaExamen[0]['id'])->with('question', 'answers')->inRandomOrder()->get();
                    return view('frontend.examen.index', ['success'=>true, 'examens'=>$qnaExamen, 'qna'=>$qna]);
                }
                else {
                    return view('frontend.examen.index', ['success'=>false, 'message'=>'This examen is not available for now!', 'examens'=>$qnaExamen]);
                }

            }
            else if ($qnaExamen[0]['date'] > date('Y-m-d'))  {
                return view('frontend.examen.index', ['success'=>false, 'message'=>'This examen will be start on'.$qnaExamen[0]['date'], 'examens'=>$qnaExamen]);
            }
            else {
                return view('frontend.examen.index', ['success'=>false, 'message'=>'This examen has been expired on'.$qnaExamen[0]['date'], 'examens'=>$qnaExamen]);
            }

        }
        else {
            return view('404');
        }

    }


    // submit examen in frontend

    public function examenSubmit(Request $request)
    {
        $exam_attempt_id = ExamensAttempt::insertGetId([
            'examen_id' => $request->examen_id,
            'user_id' => Auth::user()->id
        ]);

        $qcount = count($request->q);

        if ($qcount > 0) {

            for ($i=0; $i < $qcount; $i++) {
                if (!empty($request->input('ans_'.($i+1)))) {
                    # code...

                    ExamensAnswersFront::insert([
                        'exam_attempt_id' => $exam_attempt_id,
                        'question_id' => $request->q[$i],
                        'answer_id' => request()->input('ans_'.($i+1))
                    ]);
                }

            }
        }

        return view('thank-you');

    }


    // frontend course
    public function frondtendCourse($id)
    {
        # code...

        $courses = Course::where('copy_link',$id)->get();
        if (count($courses) > 0) {

            return view('frontend.course.index', ['success'=>true, 'courses'=>$courses]);

        }
        else {
            return view('404');
        }
        // return view('frontend.course.index');
    }

}
