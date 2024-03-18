<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerModule extends Model
{
    use HasFactory;


    protected $table = 'answer_modules';

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct'
    ];
}
