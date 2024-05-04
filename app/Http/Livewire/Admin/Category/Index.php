<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;
    public $categories = [];

    public function mount()
    {
        $this->categories = Category::orderBy('id', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.admin.category.index');
    }

    // for delete category
    public function deleteCategory($category_id)
    {
        // dd($category_id);
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        $path = 'uploads/category/'.$category->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete($path);
        session()->flash('message', 'Category Deleted');

        $this->dispatchBrowserEvent('close-modal');
    }
}