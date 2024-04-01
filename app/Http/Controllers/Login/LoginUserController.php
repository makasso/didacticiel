<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginUserController extends Controller
{
    //page login
    public function loginUser()
    {
        return view('auth.login');
    }

    // page update profile
    public function updateProfileProf()
    {
        return view('profile.prof.edit');
    }

    // page update profile
    public function updateProfile()
    {
        return view('profile.edit');
    }

    // page update password
    public function updatePassword()
    {
        return view('profile.password');
    }

    // page update password Prof
    public function updatePasswordProf()
    {
        return view('profile.prof.password');
    }

    public function userLogin(Request $request)
    {

        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required',
        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if (Auth::user()->role_as == 1) {
                alert()->success( Auth::user()->name . ' vous êtes connecté en tant que Administrateur');
                return redirect('/admin/dashboard');
            }
            else{
                if (Auth::user()->expiry_date >= Carbon::today()) {
                    alert()->success( Auth::user()->name . ' vous êtes connecté en tant que professeur');
                    return redirect('/prof/dashboard');
                }else {
                    alert()->error('Votre date de validité a expiré');
                    return back(); 
                }
            }
        } else{
            alert()->error('Email ou mot de passe invalide!');
            return back();
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        alert()->success('Déconnexion réussie', 'Vous êtes déconnecté!');
        return redirect('/');
    }

    public function updateAdminProfile(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'email' => 'string|required|email|unique:users,id'
        ]);

        $user = User::where('id', '=', auth()->id())->first();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect('/admin/profile/edit');
    }

    public function updateAdminPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'string|required',
            'password' => 'string|required|confirmed',
        ]);

        if (! Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->back()->with('error', 'Le mot de passe actuel ne correspond pas');
        }

        $user = User::where('id', '=', auth()->id())->first();
        $user->password = Hash::make($request->password);

        $user->save();

        alert()->success('Votre mot de passe a été mis à jour avec succès');
        return redirect('/admin/profile/password');
    }
}
