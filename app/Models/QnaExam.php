<?php

namespace App\Models;

use App\Models\AnswerExamen;
use App\Models\QuestionExamen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QnaExam extends Model
{
    use HasFactory;

    public $table = "qna_exams";

    protected $fillable = [
        'examen_id',
        'question_id'
    ];


    public function question()
    {
        return $this->hasMany(QuestionExamen::class, 'id', 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(AnswerExamen::class, 'question_id', 'question_id');
    }

}
