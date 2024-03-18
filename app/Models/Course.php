<?php

namespace App\Models;

use App\Models\User;
use App\Models\Examen;
use App\Models\Module;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'duree',
        'number_module',
    ];

    public function examenCourses()
    {
        return $this->hasMany(Examen::class, 'course_id', 'id');
    }

    public function modulesCourses()
    {
        return $this->hasMany(Module::class, 'course_id', 'id');
    }


    public function categoriesCourses()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function user()
    {
        # code...
        return $this->hasOne(User::class, 'id', 'user_id');
    }


}
