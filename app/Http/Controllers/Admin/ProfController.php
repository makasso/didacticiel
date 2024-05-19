<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Course;
use App\Helpers\Helper;
use App\Models\Company;
use App\Models\UserCourse;
use App\Mail\NewProfCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
// use App\Http\Requests\UserFormRequest;

class ProfController extends Controller
{

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->with('companyUser')->where('role_as', '0')->get();
        confirmDelete('Supprimer le prof?', 'Voulez-vous vraiment supprimer le prof?');
        return view('admin.prof.index', compact('users'));

    }

    public function create()
    {
        $courses = Course::all();
        $companies = Company::all();
        return view('admin.prof.create', compact('courses', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|min:2',
            'company_id' => 'int|required',
            'email'=> 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:6',
            'expiry_date' => 'required',
            'course_id' => 'required',
        ]);

        try {

        DB::transaction(function () use ($request) {
            $user = new User;

            $user->name = $request->name;
            $user->company_id = $request->company_id;
            $user->email = $request->email;
            $user->expiry_date = $request->expiry_date;
            $user->speciality = $request->speciality;
            $matricule = Helper::IDGenerator(new User, 'matricule', 'RDU', 5);
    
            $user->matricule = $matricule;
    
            $user->password = Hash::make($request->password);
    
            $user->save();
    
            UserCourse::create([
                'user_id' => $user->id,
                'course_id' => $request->course_id,
            ]);
    
            Mail::to($user->email)->send(new NewProfCreated($user, $request->password));
        });    
            
 
        } catch (\Exception $e) {
            return redirect('admin/prof')->withToastError('Une erreur est survenue');
        }

        return redirect('admin/prof')->withToastSuccess('Un nouveau prof a été ajouté avec succès');

    }


    // function update category
    public function edit(User $user)
    {
        $user = User::with('companyUser')->where('id', $user->id)->first();
        $companies = Company::all();
        $courses = Course::all();
        return view('admin.prof.edit', compact('user', 'courses', 'companies'));
    }

    public function show(User $user)
    {
        return view('admin.prof.show', compact('user'));
    }

    // update prof
    public function update(Request $request, $user)
    {
        $user = User::findOrFail($user);

        $request->validate([
            'name' => 'string|min:2',
            'company_id' => 'int|required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->company_id = $request->company_id;
        $user->speciality = $request->speciality;
        $user->email = $request->email;
        $user->expiry_date = $request->expiry_date;
        $user->speciality = $request->speciality;

        $user->update();

        return redirect('admin/prof')->withToastSuccess('Informations du prof mises à jour!');
    }


    public function destroy($user)
    {
        User::findOrFail($user)->delete();

        return redirect('admin/prof')->withToastSuccess('Professeur supprimé avec succès');

    }

    public function getCourses(Request $request)
    {
        $courses = Course::all();
        $counter = 0;
        $data = [];

        foreach ($courses as $course) {
            $userCourse = UserCourse::where('user_id', $request->user_id)->where('course_id', $course->id)->get();

            if (count($userCourse) == 0) {
                $data[$counter]['id'] = $course->id;
                $data[$counter]['name'] = $course->name;

                $counter++;
            }
        }

        return response()->json(['success' => true, 'data' => $data]);
    }


    public function addCourses(Request $request)
    {
        if (isset($request->courses_ids)) {

            foreach ($request->courses_ids as $course_id) {
                UserCourse::insert([
                    'user_id' => $request->user_id,
                    'course_id' => $course_id,
                ]);
            }

        }
        return response()->json(['success'=>true, 'message'=> 'Cours ajouté(s) avec succès!']);

    }

    public function showCourses(Request $request)
    {
        $courses = Course::select('courses.*')
        ->join('user_course', 'courses.id', '=', 'user_course.course_id')
        ->join('users', 'user_course.user_id', '=', 'users.id')
        ->where('user_course.user_id', '=', $request->user_id)
        ->get();

        return response()->json(['success' => true, 'data' => $courses]);
    }

    public function deleteCourse(Request $request)
    {
        UserCourse::where(['user_id' => $request->user_id, 'course_id' => $request->course_id])->delete();
        return response()->json(['success'=>true, 'message'=> 'Cours supprimé avec succès!']);

    }
}
