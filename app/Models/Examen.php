<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Subjet;
use App\Models\QnaExam;
use App\Models\Student;
use App\Models\ExamensAttempt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'examens';

    protected $fillable = [
        'course_id',
        'name',
        'date',
        'time',
        'attempt',
        'copy_link',

    ];

    protected $appends = ['attempt_counter'];
    public $count = '';
    public function getIdAttribute($value)
    {
        $attemptCount = ExamensAttempt::where(['examen_id'=>$value, 'student_id'=>auth()->user()->id])->count();
        $this->count = $attemptCount;
        return $value;
    }
    public function getAttemptCounterAttribute()
    {
        return $this->count;
    }


    public function coursesExamens()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function studentExamens()
    {
        return $this->belongsToMany(Student::class);
    }


    public function getQnaExamens()
    {
        return $this->hasMany(QnaExam::class, 'examen_id', 'id');
    }

}
