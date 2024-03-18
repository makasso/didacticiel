<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulesAnswersFront extends Model
{
    use HasFactory;

    protected $table = 'modules_answers_fronts';

    protected $fillable = [
        'module_attempt_id',
        'question_id',
        'answer_id',
    ];
}
