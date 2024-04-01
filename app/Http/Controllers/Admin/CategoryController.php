<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::latest()->get();
        confirmDelete('Supprimer la catégorie?', 'Voulez-vous vraiment supprimer cette catégorie?');
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }


    public function store(CategoryFormRequest $request)
    {
        $validateData = $request->validated();

        $category = new Category;

        $category->name = $validateData['name'];
        $category->description = $validateData['description'];

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath.$filename;
        }

        $category->status = $request->status == true ? '1': '0';
        $category->save();

        return redirect('admin/category')->withToastSuccess('Category Added Successfully');
    }

    // function update category
    public function edit(Category $category)
    {        
        return view('admin.category.edit', compact('category'));
    }

    // update category
    public function update(CategoryFormRequest $request, $category)
    {
        $validateData = $request->validated();

        $category = Category::find($category);

        $category->name = $validateData['name'];
        $category->description = $validateData['description'];
        $category->status = $request->status == 'on' ? '1': '0';

        // upload image
        if ($request->hasFile('image')) {

            $uploadPath = 'uploads/category/';
            $path = 'uploads/category/'.$category->image;

            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath.$filename;
        }

        $category->save();

        return redirect('admin/category')->withToastSuccess('Catégorie modifiée avec succès');
    }

    public function destroy($category) {
        
        $category = Category::find($category);
        $path = 'uploads/category/'.$category->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete($path);

        return redirect('admin/category')->withToastSuccess('Catégorie supprimée avec succès');
    }
}
