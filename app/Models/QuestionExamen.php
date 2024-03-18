<?php

namespace App\Models;

use App\Models\AnswerExamen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionExamen extends Model
{
    use HasFactory;

    protected $table = 'question_examens';

    protected $fillable = [
        'question',
    ];


    public function answers()
    {
        return $this->hasMany(AnswerExamen::class, 'question_id', 'id');
    }
}
