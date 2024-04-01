<?php

namespace App\Http\Livewire\Admin\Examen;

use App\Models\Course;
use App\Models\Examen;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $date, $time, $attempt, $course_id, $examen_id;

    public function rules()
    {
        return [
            'course_id' => 'required|integer',
            'name' => 'required|string',
            'date' => 'required',
            'time' => 'required|string',
            'attempt' => 'required|integer',
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->course_id = NULL;
        $this->date = NULL;
        $this->time = NULL;
        $this->attempt = NULL;
    }


    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function render()
    {
        $courses = Course::All();
        $examens = Examen::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.examen.index', ['courses' => $courses, 'examens' => $examens])
            ->extends('layouts.admin');
    }

    public function storeExamen()
    {
        $validatedData = $this->validate();

        $myuid = uniqid('exam');
        Examen::insert([
            'name' => $this->name,
            'course_id' => $this->course_id,
            'date' => $this->date,
            'time' => $this->time,
            'attempt' => $this->attempt,
            'copy_link' => $myuid
        ]);
        session()->flash('message', 'Examen Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }


    // edit Examen
    public function editExamen(int $examen_id)
    {
        $this->examen_id = $examen_id;
        $examen = Examen::findOrFail($examen_id);
        $this->name = $examen->name;
        $this->course_id = $examen->course_id;
        $this->date = $examen->date;
        $this->time = $examen->time;
        $this->attempt = $examen->attempt;
    }

    // update Examen
    public function updateExamen()
    {
        $validatedData = $this->validate();
        Examen::findOrFail($this->examen_id)->update([
            'name' => $this->name,
            'course_id' => $this->course_id,
            'date' => $this->date,
            'time' => $this->time,
            'attempt' => $this->attempt,
        ]);
        session()->flash('message', 'Examen Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    // delete examen
    public function deleteExamen($examen_id)
    {
        $this->examen_id = $examen_id;
    }

    // destroy examen
    public function destroyExamen()
    {
        Examen::findOrFail($this->examen_id)->delete();
        session()->flash('message', 'Examen Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();

    }

}
