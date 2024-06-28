<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderVideo extends Model
{
    use HasFactory;

    protected $table = 'slider_videos';

    protected $fillable = [
        'slider_id',
        'videos',
        'video_id',
    ];
}
