<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LoginToken;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthStudentController extends Controller
{
    public function showLoginStudent()
    {
        return view('auth.login-student');
    }

    public function loginStudent(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
        ]);

        $student = Student::where('email', $data['email'])->first();

        // On envoie un lien dans son email s'il existe si c'est pas le cas on le crée avant de l'envoyer
        if ($student) {
            $student->sendLoginLink();
        } else {
            $newStudent =  Student::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'name' => $request->firstname . ' ' . $request->lastname,
                'email' => $data['email'],
            ]);
            $newStudent->sendLoginLink();
        }

        return redirect()
        ->back()
        ->withToastSuccess('Un lien de connexion a été envoyé à l \'adresse ' . $data['email']);
    }

    public function verifyLogin(Request $request, $token)
    {
        $token = LoginToken::where('token', hash('sha256', $token))->firstOrFail();
        abort_unless($request->hasValidSignature() && $token->isValid(), 401);
        $token->consume();
        Auth::guard('student')->login($token->student);
        
        return redirect()->intended()->withToastSuccess('Bienvenue vous êtes connecté en tant qu\'étudiant.');
    }

    public function getNameByEmail(Request $request)
    {
        $email = $request->email;
        $student = Student::where('email', $email)->first();

        if ($student) {
            return response()->json(['firstname' => $student->firstname, 'lastname' => $student->lastname]);
        } else {
            return response()->json(['name' => null]);
        }
    }
}
