<?php

namespace App\Http\Livewire\Admin\Module;

use App\Models\Course;
use App\Models\Module;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $course_id, $module_id, $time, $attempt, $status;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'course_id' => 'required|integer',
            'time' => 'required|string',
            'attempt' => 'required|integer',
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->course_id = NULL;
        $this->time = NULL;
        $this->attempt = NULL;
        $this->status = NULL;

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
        $modules = Module::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.module.index', ['modules' => $modules, 'courses' => $courses])
            ->extends('layouts.admin');
    }

    public function storeModule()
    {
        $validatedData = $this->validate();
        Module::create([
            'name' => $this->name,
            'course_id' => $this->course_id,
            'time' => $this->time,
            'attempt' => $this->attempt,
            'status' => $this->status == true ? '1': '0'
        ]);
        session()->flash('message', 'Module Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }


    // edit Module
    public function editModule(int $module_id)
    {
        $this->module_id = $module_id;
        $module = Module::findOrFail($module_id);
        $this->name = $module->name;
        $this->course_id = $module->course_id;
    }

    // update module
    public function updateModule()
    {
        $validatedData = $this->validate();
        Module::findOrFail($this->module_id)->update([
            'name' => $this->name,
            'course_id' => $this->course_id,
            'time' => $this->time,
            'attempt' => $this->attempt,
            'status' => $this->status == true ? '1': '0'
        ]);
        session()->flash('message', 'Module Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    // delete module
    public function deleteModule($module_id)
    {
        $this->module_id = $module_id;
    }

    // destroy module
    public function destroyModule()
    {
        Module::findOrFail($this->module_id)->delete();
        session()->flash('message', 'Module Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();

    }


}
