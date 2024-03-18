<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerExamen;
use App\Models\Examen;
use App\Models\ExamensAnswersFront;
use App\Models\ExamensAttempt;
use App\Models\QnaExam;
use App\Models\QuestionExamen;
use Illuminate\Http\Request;

class QnAController extends Controller
{
    //
    public function index()
    {
        // answers la fonction situer dans le model QuestionExamen
        $questions = QuestionExamen::with('answers')->get();
        return view('admin.qnaans.index', compact('questions'));
    }

    // create Q&A
    public function create(Request $request)
    {

        try {

            $questionId = QuestionExamen::insertGetId([
                'question' => $request->question
            ]);

            foreach ($request->answers as $answer) {

                $is_correct = 0;
                if ($request->is_correct == $answer) {
                    $is_correct = 1;
                }

                AnswerExamen::insert([
                    'question_id' => $questionId,
                    'answer' => $answer,
                    'is_correct' => $is_correct

                ]);
            }

            return response()->json(['success'=>true, 'message'=> 'Question and answer add Successfully!']);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }


    // show details answers
    public function getQnaDetails(Request $request)
    {
        // answers la fonction situer dans le model QuestionExamen
        $qna = QuestionExamen::where('id', $request->qid)->with('answers')->get();

        return response()->json(['data'=>$qna]);
    }

    // delete answers
    public function deleteAns(Request $request)
    {
        AnswerExamen::where('id', $request->id)->delete();
        return response()->json(['success'=>true, 'message'=>'Answer deleted successfully']);
    }


    // update Q&A
    public function update(Request $request)
    {
        try {

            QuestionExamen::where('id', $request->question_id)->update([

                'question'=> $request->question,
            ]);

            // old answer update
            if (isset($request->answers)) {

                foreach ($request->answers as $key => $value) {

                    $is_correct = 0;
                    if($request->is_correct == $value){

                        $is_correct = 1;
                    }

                    AnswerExamen::where('id', $key)->update([
                        'question_id' => $request->question_id,
                        'answer' => $value,
                        'is_correct' => $is_correct
                    ]);
                }
            }


            // new answer added
            if (isset($request->new_answers)) {

                foreach ($request->new_answers as $answer) {

                    $is_correct = 0;
                    if($request->is_correct == $answer){

                        $is_correct = 1;
                    }

                    AnswerExamen::insert([
                        'question_id' => $request->question_id,
                        'answer' => $answer,
                        'is_correct' => $is_correct
                    ]);

                }
            }
            return response()->json(['success'=>true, 'message'=>'Q&A updated successfully!']);


        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }

    }


    // delect Q&A
    public function delete(Request $request)
    {
        QuestionExamen::where('id', $request->id)->delete();
        AnswerExamen::where('question_id', $request->id)->delete();

        return response()->json(['success'=>true, 'message'=>'Q&A Delete successfully!']);

    }


    // get Question in examen
    public function getQuestionsExamen(Request $request)
    {
        try {
            //code...
            $questions = QuestionExamen::all();

            if (count($questions) > 0) {
                # code...
                $data = [];
                $counter = 0;


                foreach ($questions as $question) {

                    $qnaExam = QnaExam::where(['examen_id'=>$request->examen_id, 'question_id'=>$question->id])->get();

                    if (count($qnaExam) == 0) {
                        $data[$counter]['id'] = $question->id;
                        $data[$counter]['question'] = $question->question;
                        $counter++;
                    }
                }

                return response()->json(['success'=>true, 'message'=>'Questions data !', 'data'=>$data]);


            }
            else {
                return response()->json(['success'=>false, 'message'=>"Questions not Found!"]);

            }


        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
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
            return response()->json(['success'=>true, 'message'=>'Question added Successfully!']);


        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }


    // get and show examen question
    public function getExamenQuestions(Request $request)
    {
        # code...
        try {


            $data = QnaExam::where('examen_id', $request->examen_id)->with('question')->get();
            return response()->json(['success'=>true, 'message'=>'Questions details!', 'data'=>$data]);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }

    // delete show examen question
    public function deleteExamenQuestions(Request $request)
    {
        # code...
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

        return view('admin.review.review-examen', compact('examensAttempts'));

    }


    // get reviewQna
    public function reviewQna(Request $request)
    {
        # code...

        try {
            //code...
            $attemptData = ExamensAnswersFront::where('exam_attempt_id', $request->exam_attempt_id)->with(['question','answers'])->get();
            return response()->json(['success'=>true, 'data'=> $attemptData ]);


        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }

    }


    // approved submit
    public function approvedQna(Request $request)
    {
        # code...

        try {
            //code...
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
