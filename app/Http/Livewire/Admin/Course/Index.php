<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $courses = Course::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.course.index', ['courses'=>$courses]);
    }
}
