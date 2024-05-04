<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulesAttempt extends Model
{
    use HasFactory;

    protected $table = 'modules_attempts';

    protected $fillable = [
        'module_id',
        'student_id',
        'marks',
    ];
}
