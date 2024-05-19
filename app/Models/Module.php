<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\Course;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $fillable = [
        'course_id',
        'name',
        'time',
    ];


    public function slidersModules()
    {
        return $this->hasMany(Slider::class, 'module_id', 'id');
    }


     public function coursesCategories()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }

    public function coursesModules()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
