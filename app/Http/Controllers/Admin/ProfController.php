<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
// use App\Http\Requests\UserFormRequest;

class ProfController extends Controller
{

    public function index()
    {

        return view('admin.prof.index');

    }

    public function create()
    {
        return view('admin.prof.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required|min:2',
            'company' => 'string|required|min:2',
            'speciality' => 'string|required|min:2',
            'email'=> 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:6',
            'expiry_date' => 'required'
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->company = $request->company;
        $user->speciality = $request->speciality;
        $user->email = $request->email;
        $user->expiry_date = $request->expiry_date;
        $user->speciality = $request->speciality;
        $matricule = Helper::IDGenerator(new User, 'matricule', 5, 'RDU');

        $user->matricule = $matricule;

        $user->password = Hash::make($request->password);

        $user->save();
        return redirect('admin/prof')->with('message', 'Un nouveau prof a ete ajoute sans success');

    }


    // function update category
    public function edit(User $user)
    {
        return view('admin.prof.edit', compact('user'));
    }

    // update prof
    public function update(Request $request, $user)
    {
        $request->validate([
            'name' => 'string|min:2',
            'company' => 'string|min:2',
            'speciality' => 'string|min:2',
            'email'=> 'string|email|max:100',
            // 'expiry_date' => 'required'
        ]);

        $user = User::findOrFail($user);

        $user->name = $request->name;
        $user->company = $request->company;
        $user->speciality = $request->speciality;
        $user->email = $request->email;
        $user->expiry_date = $request->expiry_date;
        $user->speciality = $request->speciality;

        $user->update();

        return redirect('admin/prof')->with('message', 'Mise a jour des informations du prof');
    }


    public function destroy($user)
    {
        User::findOrFail($user)->delete();

        return redirect('admin/prof')->with('message', 'User Deleted Successfully');

    }
}
