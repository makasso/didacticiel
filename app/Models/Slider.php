<?php

namespace App\Models;

use App\Models\Module;
use App\Models\SliderImage;
use App\Models\SliderVideo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $fillable = [
        'module_id',
        'name',
        'description',
        'is_introduction',
    ];


    public function modulesSliders()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    //recherche tout les images en cas de ontomany
    public function sliderImages()
    {
        return $this->hasMany(SliderImage::class, 'slider_id', 'id');
    }

    //recherche tout les images en cas de ontomany
    public function sliderVideos()
    {
        return $this->hasMany(SliderVideo::class, 'slider_id', 'id');
    }
}
