<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ModuleController extends Controller
{
    public function index()
    {
        $courses = Course::All();
        $modules = Module::orderBy('id', 'DESC')->get();

        confirmDelete('Supprimer le module?', 'Voulez-vous réellement supprimer ce module?');
        return view('admin.module.index', ['modules' => $modules, 'courses' => $courses]);
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $courses = Course::all();
        return view('admin.module.create', compact('courses', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'course_id' => 'required|integer',
        ]);

        Module::create([
            'name' => $request->name,
            'course_id' => $request->course_id,
        ]);

        return redirect('/admin/module')->withToastSuccess('Module créé avec succès');
    }

    // Edit Module
    public function edit(Request $request, int $module_id)
    {
        $module = Module::where('id', $module_id)->first();
        $courses = Course::All();
        $categories = Category::all();

        return view('admin.module.edit', compact('module', 'courses', 'categories'));
    }

    public function show(int $module_id)
    {
        $module = Module::find($module_id);
        
        return view('admin.module.show', compact('module',));
    }

    public function update(Request $request, int $module_id)
    {
        $request->validate([
            'name' => 'required|string',
            'course_id' => 'required|integer',
        ]);

        Module::findOrFail($module_id)->update([
            'name' => $request->name,
            'course_id' => $request->course_id,
            'time' => $request->time,
        ]);

        return redirect('admin/module')->withToastSuccess('Module mis à jour avec succès!');

    }

    // Delete Module
    public function destroy($module_id)
    {
        Module::find($module_id)->delete();

        return redirect()->back()->withToastSuccess('Module supprimé avec succès');
    }
}
