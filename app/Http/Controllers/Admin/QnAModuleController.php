<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnswerModule;
use App\Models\QnaModule;
use App\Models\QuestionModule;
use Illuminate\Http\Request;

class QnAModuleController extends Controller
{
    //
    public function index()
    {
        // answers la fonction situer dans le model QuestionExamen
        $questions = QuestionModule::with('answers')->get();
        return view('admin.qnaans-module.index', compact('questions'));
    }

    // create Q&A
    public function create(Request $request)
    {

        try {

            $questionId = QuestionModule::insertGetId([
                'question' => $request->question
            ]);

            foreach ($request->answers as $answer) {

                $is_correct = 0;
                if ($request->is_correct == $answer) {
                    $is_correct = 1;
                }

                AnswerModule::insert([
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
        $qna = QuestionModule::where('id', $request->qid)->with('answers')->get();

        return response()->json(['data'=>$qna]);
    }

    // delete answers
    public function deleteAns(Request $request)
    {
        AnswerModule::where('id', $request->id)->delete();
        return response()->json(['success'=>true, 'message'=>'Answer deleted successfully']);
    }


    // update Q&A
    public function update(Request $request)
    {
        try {

            QuestionModule::where('id', $request->question_id)->update([

                'question'=> $request->question,
            ]);

            // old answer update
            if (isset($request->answers)) {

                foreach ($request->answers as $key => $value) {

                    $is_correct = 0;
                    if($request->is_correct == $value){

                        $is_correct = 1;
                    }

                    AnswerModule::where('id', $key)->update([
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

                    AnswerModule::insert([
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


    public function delete(Request $request)
    {
        QuestionModule::where('id', $request->id)->delete();
        AnswerModule::where('question_id', $request->id)->delete();

        return response()->json(['success'=>true, 'message'=>'Q&A Delete successfully!']);

    }





    // get Question in module
    public function getQuestionsModule(Request $request)
    {
        try {
            //code...
            $questions = QuestionModule::all();

            if (count($questions) > 0) {
                # code...
                $data = [];
                $counter = 0;


                foreach ($questions as $question) {

                    $qnaModule = QnaModule::where(['module_id'=>$request->module_id, 'question_id'=>$question->id])->get();

                    if (count($qnaModule) == 0) {
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


    // add questions module
    public function addQuestionsModule(Request $request)
    {
        try {

            if (isset($request->questions_ids)) {

                foreach ($request->questions_ids as $qid) {

                    QnaModule::insert([
                        'module_id' => $request->module_id,
                        'question_id'=> $qid
                    ]);

                }
            }
            return response()->json(['success'=>true, 'message'=>'Question added Successfully!']);


        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }


    // get and show module question
    public function getModuleQuestions(Request $request)
    {
        # code...
        try {


            $data = QnaModule::where('module_id', $request->module_id)->with('question')->get();
            return response()->json(['success'=>true, 'message'=>'Questions details!', 'data'=>$data]);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }

    // delete show module question
    public function deleteModuleQuestions(Request $request)
    {
        # code...
        try {


            QnaModule::where('id', $request->id)->delete();
            return response()->json(['success'=>true, 'message'=>'Questions Module deleted!']);

        } catch (\Exception $e) {
            return response()->json(['success'=>false, 'message'=>$e->getMessage()]);
        }
    }



}
