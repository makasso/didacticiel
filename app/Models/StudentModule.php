<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModule extends Model
{
    use HasFactory;

    protected $table = 'student_module';

    protected $fillable = ['student_id', 'module_id', 'is_completed'];
}
