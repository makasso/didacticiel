<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\Examen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'name',
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
}
