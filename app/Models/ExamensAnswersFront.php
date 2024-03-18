<?php

namespace App\Models;

use App\Models\AnswerExamen;
use App\Models\QuestionExamen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamensAnswersFront extends Model
{
    use HasFactory;

    protected $table = 'examens_answers_front';

    protected $fillable = [
        'exam_attempt_id',
        'question_id',
        'answer_id',
    ];


    public function question()
    {
        # code...
        return $this->hasOne(QuestionExamen::class, 'id', 'question_id');
    }

    public function answers()
    {
        # code...
        return $this->hasOne(AnswerExamen::class, 'id', 'answer_id');
    }

}
