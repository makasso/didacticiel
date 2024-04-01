<?php

namespace App\Http\Livewire\Prof\Examen;

use App\Models\Examen;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $examens = Examen::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.prof.examen.index', ['examens'=> $examens]);
    }
}
