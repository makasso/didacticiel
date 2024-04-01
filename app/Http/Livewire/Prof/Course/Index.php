<?php

namespace App\Http\Livewire\Prof\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $courses = Course::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.prof.course.index', ['courses'=>$courses]);
    }
}
