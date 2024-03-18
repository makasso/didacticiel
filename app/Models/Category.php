<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'image',
        'status'
    ];


    public function coursesCategories()
    {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }
}
