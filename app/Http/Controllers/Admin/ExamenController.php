<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Examen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamenController extends Controller
{
    public function index()
    {
        $courses = Course::All();
        $examens = Examen::orderBy('id', 'DESC')->get();
        confirmDelete('Supprimer examen?', 'Voulez-vous vraiment supprimer cet examen?');
        return view('admin.examen.index', compact('courses', 'examens'));
    }

    public function create()
    {
        $courses = Course::All();

        return view('admin.examen.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer',
            'name' => 'required|string',
            'date' => 'required',
            'time' => 'required|string',
            'attempt' => 'required|integer',
        ]);

        $myuid = uniqid('exam');

        Examen::create([
            'name' => $request->name,
            'course_id' => $request->course_id,
            'date' => $request->date,
            'time' => $request->time,
            'attempt' => $request->attempt,
            'copy_link' => $myuid
        ]);

        return redirect('admin/examen')->withToastSuccess('Examen crée avec succès!');
    }

    public function update(Request $request, int $examen_id)
    {
        $request->validate([
            'course_id' => 'required|integer',
            'name' => 'required|string',
            'date' => 'required',
            'time' => 'required|string',
            'attempt' => 'required|integer',
        ]);

        $exam = Examen::find($examen_id);

        if ($exam) {
            $exam->name = $request->name;
            $exam->course_id = $request->course_id;
            $exam->date = $request->date;
            $exam->time = $request->time;
            $exam->attempt = $request->attempt;

            $exam->update();

            return redirect()->back()->withToastSuccess('Examen mis à jour avec succès!');
        }

        return redirect()->back()->withToastError('Impossible de mettre l\'examen à jour!');
    }

    public function destroy(int $examen_id)
    {
        Examen::where('id', $examen_id)->delete();
        return redirect('admin/examen')->withToastSuccess('Examen Supprimé avec succès!');
    }
}
