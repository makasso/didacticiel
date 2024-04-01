<?php

namespace App\Http\Livewire\Admin\Quiz;


use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // public $module_id, $question, $a, $b, $c, $d, $ans, $quiz_id;

    // public function rules()
    // {
    //     return [
    //         'module_id' => 'required|integer',
    //         'question' => 'required|string',
    //         'a' => 'required|string',
    //         'b' => 'required|string',
    //         'c' => 'required|string',
    //         'd' => 'required|string',
    //         'ans' => 'required|string',
    //     ];
    // }

    // public function resetInput()
    // {
    //     $this->module_id = NULL;
    //     $this->question = NULL;
    //     $this->a = NULL;
    //     $this->b = NULL;
    //     $this->c = NULL;
    //     $this->d = NULL;
    //     $this->ans = NULL;

    // }


    // public function closeModal()
    // {
    //     $this->resetInput();
    // }

    // public function openModal()
    // {
    //     $this->resetInput();
    // }



    // public function storeQuiz()
    // {
    //     $validatedData = $this->validate();
    //     Quiz::create([
    //         'module_id' => $this->module_id,
    //         'question' => $this->question,
    //         'a' => $this->a,
    //         'b' => $this->b,
    //         'c' => $this->c,
    //         'd' => $this->d,
    //         'ans' => $this->ans,
    //     ]);
    //     session()->flash('message', 'Quiz Added Successfully');
    //     $this->dispatchBrowserEvent('close-modal');
    //     $this->resetInput();
    // }


    // // edit Module
    // public function editQuiz(int $quiz_id)
    // {
    //     $this->quiz_id = $quiz_id;
    //     $quiz = Quiz::findOrFail($quiz_id);
    //     $this->module_id = $quiz->module_id;
    //     $this->question = $quiz->question;
    //     $this->a = $quiz->a;
    //     $this->b = $quiz->b;
    //     $this->c = $quiz->c;
    //     $this->d = $quiz->d;
    //     $this->ans = $quiz->ans;
    // }

    // // update module
    // public function updateQuiz()
    // {
    //     $validatedData = $this->validate();
    //     Quiz::findOrFail($this->quiz_id)->update([
    //         'module_id' => $this->module_id,
    //         'question' => $this->question,
    //         'a' => $this->a,
    //         'b' => $this->b,
    //         'c' => $this->c,
    //         'd' => $this->d,
    //         'ans' => $this->ans,
    //     ]);
    //     session()->flash('message', 'Quiz Updated Successfully');
    //     $this->dispatchBrowserEvent('close-modal');
    //     $this->resetInput();
    // }

    // // delete quiz
    // public function deleteQuiz($quiz_id)
    // {
    //     $this->quiz_id = $quiz_id;
    // }

    // // destroy quiz
    // public function destroyQuiz()
    // {
    //     Quiz::findOrFail($this->quiz_id)->delete();
    //     session()->flash('message', 'Quiz Deleted Successfully');
    //     $this->dispatchBrowserEvent('close-modal');
    //     $this->resetInput();

    // }

    // public function render()
    // {
    //     $modules = Module::All();
    //     $quizzes = Quiz::orderBy('id', 'DESC')->paginate(10);
    //     return view('livewire.admin.quiz.index', ['modules'=> $modules, 'quizzes'=> $quizzes])
    //         ->extends('layouts.admin');
    // }


}
