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
    
                @forelse ($slider as $sl)
                    <h3 class="title my-2">{{ $sl->name }}</h3>
                    @foreach (\App\Models\SliderImage::where('slider_id', $sl->id)->get() as $image)
                        <div class="swiper-slide">
                            <img src="{{ url($image->image) }}" class="img-fluid w-100"
                                style="height: 100%; object-fit: content;" alt="Responsive image">
                        </div>
                    @endforeach
    
                    @foreach (\App\Models\SliderVideo::where('slider_id', $sl->id)->get() as $video)
                        @isset($video)
                        <div class="swiper-slide">
                            <video class="w-100" style="height: 100%" controls>
                                <source src="{{ url($video->videos) }}">
                            </video>
                        </div>
                        @endisset
                    @endforeach
                @empty
                    <h5 class="text-center mx-auto mt-5">Aucun contenu pour l'instant!</h5>
                @endforelse
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>

@endsection

@push('scripts')
<script>
    var swiper = new Swiper(".swiper", {
        direction: "vertical",
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
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
