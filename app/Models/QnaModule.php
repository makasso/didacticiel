<?php

namespace App\Models;

use App\Models\QuestionModule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QnaModule extends Model
{
    use HasFactory;

    public $table = "qna_modules";

    protected $fillable = [
        'module_id',
        'question_id'
    ];

    public function question()
    {
        return $this->hasMany(QuestionModule::class, 'id', 'question_id');
    }
}
