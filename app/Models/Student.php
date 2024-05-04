<?php

namespace App\Models;

use App\Mail\LoginLink;
use App\Models\Quiz;
use App\Models\Examen;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;

class Student extends Authenticatable
{
    use HasFactory;

    protected $table = 'students';
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'email',
        'speciality'
    ];


    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }

    public function examens()
    {
        return $this->belongsToMany(Examen::class);
    }

    public function loginTokens()
    {
        return $this->hasMany(LoginToken::class);
    }

    public function sendLoginLink()
    {
        $plainText = Str::random(32);
        $token = $this->loginTokens()->create([
            'token' => hash('sha256', $plainText),
            'expires_at' => now()->addMinutes(15),
        ]);

        Mail::to($this->email)->queue(new LoginLink($plainText, $token->expires_at));
    }
}
