<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Module;
use App\Models\Slider;
use App\Models\SliderImage;
use App\Models\SliderVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id', 'DESC')->get();
        confirmDelete('Supprimer le slide?', 'Voulez-vous vraiment supprimer ce slide?');
        return view('admin.slider.index', ['sliders'=> $sliders]);    }


    public function create()
    {
        $courses = Course::with('modulesCourses')->get();
        return view('admin.slider.create', compact('courses'));
    }

    public function store(SliderFormRequest $request)
    {
        $validateData = $request->validated();
        $module = Module::findOrFail($validateData['module_id']);


        $slider = $module->slidersModules()->create([
            'module_id' => $validateData['module_id'],
            'name' => $validateData['name'],
            'description' => $validateData['description'],
            'is_introduction' => $request->is_introduction == 'on' ? '1' : '0'

        ]);

        // upload image of class image in slider
        if ($request->hasFile('image')) {

            $uploadPath = 'uploads/sliders/images/';

            $i = 1;
            foreach ($request->file('image') as $imagesFile) {

                $extention = $imagesFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extention;
                $imagesFile->move('uploads/sliders/images/', $filename);
                $finalImagePathName = $uploadPath.$filename;


                // save image with create the function productImages in model Product
                $slider->sliderImages()->create([
                    'slider_id' => $slider->id,
                    'image' => $finalImagePathName,
                ]);
            }

        }

        // upload videos of class image in slider
        if ($request->hasFile('videos')) {

            $uploadvideosPath = 'uploads/sliders/videos/';

            $i = 1;
            foreach ($request->file('videos') as $videosFile) {

                $extentionvideos = $videosFile->getClientOriginalExtension();
                $filenamevideos = time().$i++.'.'.$extentionvideos;
                $videosFile->move('uploads/sliders/videos/', $filenamevideos);
                $finalVideosPathName = $uploadvideosPath.$filenamevideos;

                // save videos with create the function sliderVideos in model Product
                $slider->sliderVideos()->create([
                    'slider_id' => $slider->id,
                    'videos' => $finalVideosPathName,
                ]);
            }

        }

        return redirect('admin/slider')->withToastSuccess('Slide créé avec succès');
    }


    public function edit(int $slider_id)
    {
        $modules = Module::all();
        $slider = Slider::findOrFail($slider_id);

        return view('admin.slider.edit', compact('modules', 'slider'));
    }


    public function show(int $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);

        return view('admin.slider.show', compact('slider'));
    }


    public function update(SliderFormRequest $request, int $slider_id)
    {
        $validateData = $request->validated();


        $slider = Module::findOrFail($validateData['module_id'])
                    ->slidersModules()->where('id', $slider_id)->first();


        if ($slider) {

            $slider->update([
                'module_id' => $validateData['module_id'],
                'name' => $validateData['name'],
                'description' => $validateData['description'],
                'is_introduction' => $request->is_introduction == 'on' ? '1' : '0'
            ]);


            // upload image of class image in slider
            if ($request->hasFile('image'))
            {
                $uploadPath = 'uploads/sliders/images/';

                $i = 1;
                foreach ($request->file('image') as $imagesFile) {

                    $extention = $imagesFile->getClientOriginalExtension();
                    $filename = time().$i++.'.'.$extention;
                    $imagesFile->move('uploads/sliders/images/', $filename);
                    $finalImagePathName = $uploadPath.$filename;


                    // save image with create the function productImages in model Product
                    $slider->sliderImages()->create([
                        'slider_id' => $slider->id,
                        'image' => $finalImagePathName,
                    ]);
                }

            }

            // upload videos of class image in slider
            if ($request->hasFile('videos'))
            {

                $uploadvideosPath = 'uploads/sliders/videos/';

                $i = 1;
                foreach ($request->file('videos') as $videosFile) {

                    $extentionvideos = $videosFile->getClientOriginalExtension();
                    $filenamevideos = time().$i++.'.'.$extentionvideos;
                    $videosFile->move('uploads/sliders/videos/', $filenamevideos);
                    $finalVideosPathName = $uploadvideosPath.$filenamevideos;


                    // save videos with create the function sliderVideos in model Product
                    $slider->sliderVideos()->create([
                        'slider_id' => $slider->id,
                        'videos' => $finalVideosPathName,
                    ]);
                }
            }
            return redirect('admin/slider')->with('message', 'Slider Added Succesfully');
        }
        else
        {
            return redirect('admin/slider')->with('message', 'No Such Slider Id Found');
        }
    }

    public function destroyImage(int $slider_image_id)
    {
        $SliderImage = SliderImage::findOrFail($slider_image_id);
        if (File::exists($SliderImage->image))
        {
            File::delete($SliderImage->image);
        }
        $SliderImage->delete();
        return redirect()->back()->withToastSuccess('Image slide supprimé avec succès');
    }


    public function destroyVideo(int $slider_video_id)
    {
        $SliderVideo = SliderVideo::findOrFail($slider_video_id);
        if (File::exists($SliderVideo->videos))
        {
            File::delete($SliderVideo->videos);
        }
        $SliderVideo->delete();
        return redirect()->back()->withToastSuccess('Vidéo slide supprimé avec succès');
    }


    public function destroy(int $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);

        if ($slider->sliderImages)
        {
            foreach ($slider->sliderImages as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->image);
                }
            }
        }

        if ($slider->sliderVideos)
        {
            foreach ($slider->sliderVideos as $videos) {
                if (File::exists($videos->videos)) {
                    File::delete($videos->videos);
                }
            }
        }

        $slider->delete();
        return redirect()->back()->withToastSuccess('Slide supprimé avec succès');
    }

}
