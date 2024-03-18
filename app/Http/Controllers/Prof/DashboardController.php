<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //function return page dashboard
    public function dashboard()
    {
        // $courses = Course::with('categoriesCourses')->orderBy('id')->get();
        return view('prof.dashboard');
    }

    public function index()
    {
        return view('prof.course.index');
    }

    public function indexExamen()
    {
        # code...
        return view('prof.examen.index');
    }
}
