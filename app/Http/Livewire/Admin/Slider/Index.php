<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $sliders = Slider::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.slider.index', ['sliders'=> $sliders]);
    }
}
