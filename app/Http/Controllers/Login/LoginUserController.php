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
    public function login()
    {
        return view('auth.login');
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
                return redirect('/admin/dashboard')->withToastSuccess(Auth::user()->name . ' vous êtes connecté en tant que administrateur');
            }
            else{
                if (Auth::user()->expiry_date >= Carbon::today()) {
                    return redirect('/prof/dashboard')->withToastSuccess(Auth::user()->name . ' vous êtes connecté en tant que professeur');
                }else {
                    return back()->withToastError('Votre date de validité a expiré');
                }
            }
        } else{
            return back()->withToastError('Email ou mot de passe invalide!');;
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/')->withToastSuccess('Déconnexion réussie');
    }

    public function updateProfileUser(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'email' => 'string|required|email|unique:users,id'
        ]);

        $user = User::where('id', '=', auth()->id())->first();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        if (Auth::user()->role_as == '0') {
            return redirect('/prof/profile/edit')->withToastSuccess('Votre profil a été mis à jour avec succès');

        } else {
            return redirect('/admin/profile/edit')->withToastSuccess('Votre profil a été mis à jour avec succès');
        }

    }

    public function updatePasswordUser(Request $request)
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

        if (Auth::user()->role_as == '0') {
        return redirect('/prof/profile/password')->withToastSuccess('Votre mot de passe a été mis à jour avec succès');
        } else {
        return redirect('/admin/profile/password')->withToastSuccess('Votre mot de passe a été mis à jour avec succès');

        }

    }
    
}
