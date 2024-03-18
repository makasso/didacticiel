<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
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
                return redirect('/admin/dashboard')->with('message', 'Vous venez de vous connecter en tant que Admin');
            }
            else{
                if (Auth::user()->expiry_date >= Carbon::today()) {
                    return redirect('/prof/dashboard')->with('message', 'Vous venez de vous connecter en tant que Prof');
                }else {
                    return back()->with('error', 'Votre date de validité est expirée');
                }
            }

        }
        else{
            return back()->with('error', 'Votre Email ou votre mot de passe est incorrect');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
