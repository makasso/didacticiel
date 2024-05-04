<?php

namespace App\Models;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderImage extends Model
{
    use HasFactory;

    protected $table = 'slider_images';

    protected $fillable = [
        'slider_id',
        'image'
    ];

    public function sliders()
    {
        return $this->belongsTo(Slider::class, 'slider_id', 'id');
    }

    
}
