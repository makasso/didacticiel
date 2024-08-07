<?php

namespace App\Models;

use App\Models\User;
use App\Models\Examen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamensAttempt extends Model
{
    use HasFactory;

    protected $table = 'examens_attempt';

    protected $fillable = [
        'examen_id',
        'student_id',
        'marks',
        'is_completed',
        'certificate_id',
    ];


    public function student()
    {
        # code...
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function examen()
    {
        # code...
        return $this->hasOne(Examen::class, 'id', 'examen_id');
    }

}

