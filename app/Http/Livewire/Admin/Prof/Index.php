<?php

namespace App\Http\Livewire\Admin\Prof;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $users = User::orderBy('id', 'DESC')->where('role_as', '0')->paginate(15);
        return view('livewire.admin.prof.index', ['users'=>$users]);
    }
}
