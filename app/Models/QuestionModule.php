<?php

namespace App\Models;

use App\Models\AnswerModule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionModule extends Model
{
    use HasFactory;

    protected $table = 'question_modules';

    protected $fillable = [
        'question',
        'course_id'
    ];


    public function answers()
    {
        return $this->hasMany(AnswerModule::class, 'question_id', 'id');
    }
}
