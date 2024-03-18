<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerExamen extends Model
{
    use HasFactory;

    protected $table = 'answer_examens';

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct'
    ];
}
