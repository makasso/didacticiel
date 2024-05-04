<?php

namespace App\Http\Controllers\Admin;

use App\Models\Examen;
use App\Models\QnaExam;
use App\Models\QnaModule;
use App\Models\AnswerExamen;
use Illuminate\Http\Request;
use App\Models\ExamensAttempt;
use App\Models\QuestionExamen;
use App\Models\QuestionModule;
use App\Models\ExamensAnswersFront;
use App\Http\Controllers\Controller;

class QnAController extends Controller
{

    public function getExamen(Request $request)
    {
        try {
            $examen = Examen::with('coursesExamens')->find($request->id);

            return response()->json(['success' => true, 'message' => 'Examen', 'data' => $examen]);
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
        
    }

    // get Question in examen
    public function getQuestionsExamen(Request $request)
    {
        try {
            $questions = QuestionModule::select('question_modules.*')
                                        ->join('qna_modules', 'question_modules.id', 'qna_modules.question_id')
                                        ->join('modules', 'qna_modules.module_id', 'modules.id')
                                        ->join('courses', 'modules.course_id', 'courses.id')
                                        ->where('courses.id', $request->course_id)
                                        ->get();

            if (count($questions) > 0) {
                $data = [];
                $counter = 0;    

                foreach ($questions as $question) {
                    
                    if (! QnaExam::where(['examen_id' => $request->examen_id, 'question_id' => $question->id])->exists() ){
                        $data[$counter]['id'] = $question->id;
                        $data[$counter]['question'] = $question->question;
                        $counter++;
                    }   
                }

                return response()->json(['success' => true, 'message' => 'Questions data !', 'data' => $data]);
            } else {
                return response()->json(['success' => false, 'message' => 'Aucune question trouvée!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // add questions examen
    public function addQuestionsExamen(Request $request)
    {
        try {

            if (isset($request->questions_ids)) {

                foreach ($request->questions_ids as $qid) {

                    QnaExam::insert([
                        'examen_id' => $request->examen_id,
                        'question_id'=> $qid
                    ]);

                }
            }
            return response()->json(['success'=>true, 'message'=>'Question ajoutée avec succès!']);


        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }

    // get and show examen question
    public function getExamenQuestions(Request $request)
    {
        try {
            $data = QnaExam::where('examen_id', $request->examen_id)->with('question')->get();

            return response()->json(['success'=>true, 'message'=>'Questions details!', 'data' => $data]);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }

    // delete show examen question
    public function deleteExamenQuestions(Request $request)
    {
        try {
            QnaExam::where('id', $request->id)->delete();
            return response()->json(['success'=>true, 'message'=>'Questions Examen deleted!']);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }


    // marks for examen
    public function loadMarks()
    {
        # code...
        $examens = Examen::with('getQnaExamens')->get();
        return view('admin.marks.index', compact('examens'));
    }

    // update marks examen
    public function updateMarks(Request $request)
    {
        try {

            Examen::where('id', $request->examen_id)->update([

                'marks' => $request->marks,
                'pass_marks' => $request->pass_marks
            ]);
            return response()->json(['success'=>true, 'message'=>'Marks Updated']);


        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }


    // review examen
    public function reviewExamens()
    {
        # code...
        $examensAttempts = ExamensAttempt::with(['user', 'examen'])->orderBy('id')->get();

        return view('admin.review-examen.index', compact('examensAttempts'));

    }
    
    // get reviewQna
    public function reviewQna(Request $request)
    {
        try {
            $attemptData = ExamensAnswersFront::where('exam_attempt_id', $request->exam_attempt_id)->with(['question','answers'])->get();
            return response()->json(['success'=>true, 'data'=> $attemptData ]);


        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }

    }
    // approved submit
    public function approvedQna(Request $request)
    {
        try {
            $examAttemptId = $request->exam_attempt_id;
            $examenData = ExamensAttempt::where('id', $examAttemptId)->with('examen')->get();
            $marks = $examenData[0]['examen']['marks'];

            $attemptData = ExamensAnswersFront::where('exam_attempt_id', $examAttemptId)->with('answers')->get();

            $totalMarks = 0;

            if (count($attemptData) > 0) {

                foreach ($attemptData as $attempt) {
                    # code...
                    if ($attempt->answers->is_correct == 1) {
                        # code...
                        $totalMarks += $marks;

                    }
                }
            }

          ExamensAttempt::where('id', $examAttemptId)->update([
            'status' => 1,
            'marks' => $totalMarks
          ]);

            return response()->json(['success'=>true, 'message'=>'Approved Successfully!']);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }

}
