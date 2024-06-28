@extends('layouts.frontend')

@section('title')
    {{ $course->name }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="swiper" style="height: 100vh;">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->

                    <h3 class="title my-2">{{ $course->name }}</h3>
                    @foreach ($slider->sliderImages as $image)
                        <div class="swiper-slide">
                            <img src="{{ url($image->image) }}" class="img-fluid w-100"
                                style="height: 100%; object-fit: cover;" alt="Responsive image">
                        </div>
                    @endforeach

                    @foreach ($slider->sliderVideos as $video)
                        @isset($video)
                        <div class="swiper-slide">
                            <video class="video-js"
                                   controls
                                   preload="auto"
                                   width="1280"
                                   height="685"
                                   poster="{{ url(App\Models\SliderImage::where('slider_id', $slider->id)->first()->image) }}"
                                   data-setup="{}">
                                <source src="{{ url($video->videos) }}">
                                <p class="vjs-no-js">
                                    Pour regarder cette vidéo, activez JavaScript et considérez mettre à jour votre navigateur web
                                    <a href="https://videojs.com/html5-video-support/" target="_blank" rel="noopener">support de HTML5 video</a>
                                </p>
                            </video>
                        </div>
                        @endisset
                    @endforeach
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>

@endsection

@push('scripts')
<script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>

<script>
    var swiper = new Swiper(".swiper", {
        direction: "vertical",
        // pagination: {
        //     el: ".swiper-pagination",
        //     clickable: true,
        // },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        mousewheel: {
            invert: false,
        },
        autoHeight: true,
        effect: 'slide',
    });
</script>
@endpush
