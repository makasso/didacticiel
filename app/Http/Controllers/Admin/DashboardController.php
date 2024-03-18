<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Models\Module;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //function return page dashboard
    public function dashboard()
    {
        $enseignants = User::where('role_as', '=', '0')->count();
        $cours = Course::get()->count();
        $categories = Category::get()->count();
        $modules = Module::get()->count();

        return view('admin.dashboard', compact('enseignants', 'cours', 'categories', 'modules'));
    }
}
