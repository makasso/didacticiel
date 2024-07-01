<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgetPassword()
    {
        return view('auth.forget-password');
    }

    public function submitForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email', $request->email)->first();


        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::to($request->email)->send(new ForgetPasswordMail($token));

        return redirect()->back()->withToastSuccess("Vous avez reçu le lien de réinitialisation du mot de passe via email à l'adresse ".$request->email);
    }

    public function showResetPassword(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function submitResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);


        $updatePassword = DB::table('password_resets')
            ->where([['token', $request->token], ['email', $request->email]])
            ->first();

        if($updatePassword){
           User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

           DB::table('password_resets')->where(['email'=> $request->email])->delete();

           return redirect('/login')->withToastSuccess('Votre mot de passe a été changé!');
        }
        return redirect()->back()->withInput()->withToastError('Token invalide');

    }
}
