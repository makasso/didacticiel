<?php

namespace App\Http\Livewire\Admin\Qnaans;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\QuestionExamen;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // $questions = QuestionExamen::orderBy('id', 'DESC')->paginate(10);
        // $questions = QuestionExamen::with('answersQuestion')->get()->paginate(10);
        return view('livewire.admin.qnaans.index');
    }
}
