<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseFormRequest;

class CourseController extends Controller
{
    //
    public function index()
    {
        $courses = Course::latest()->with('modulesCourses')->get();
        $users = User::where('role_as', '0')->get();

        confirmDelete('Supprimer le cours?', 'Voulez-vous vraiment supprimer ce cours?');
        return view('admin.course.index', compact('courses', 'users'));
    }


    public function create()
    {
        $categories = Category::all();
        $users = User::where('role_as', '0')->get();
        return view('admin.course.create', compact('categories', 'users'));
    }



    public function store(CourseFormRequest $request)
    {
        $validateData = $request->validated();
         $myuid = Str::random(128);

        $category = Category::findOrFail($validateData['category_id']);

        // on verifie si la categorie existe, on creer la fonctions products()
        // dans le model category
        $course = $category->coursesCategories()->insert([
            'category_id' => $validateData['category_id'],
            'user_id' => $validateData['user_id'] ?? null,
            'name' => $validateData['name'],
            'copy_link'=> $myuid
        ]);


        return redirect('admin/course')->withToastSuccess('Cours ajouté avec succès');
    }

    public function edit(int $course_id)
    {
        $categories = Category::all();
        $users = User::where('role_as', '0')->get();
        $course = Course::find($course_id);

        return view('admin.course.edit', compact('categories', 'course', 'users'));
    }

    public function update(CourseFormRequest $request, int $course_id)
    {
        $validateData = $request->validated();

        Course::find($course_id)->update([
            'category_id' => $validateData['category_id'],
            'user_id' => $validateData['user_id'] ?? null,
            'name' => $validateData['name'],
        ]);

        return redirect('admin/course')->withToastSuccess('Cours modifié avec succès');
    }

    public function destroy(int $course_id)
    {
        $course = Course::findOrFail($course_id);

        $course->delete();

        return redirect()->back()->withToastSuccess('Cours supprimé avec succès');
    }

}
