@extends('layouts.app')
@section('title')
    Module {{ $module->name }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">Module {{ $module->name }}</h4>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('prof.course.get-modules', $module->course_id) }}"
                                            class="btn btn-primary float-end">Retour</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Cours</label>
                                            <input disabled type="text" class="form-control"
                                                value="{{ $module->coursesModules->name }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nom</label>
                                            <input disabled type="text" class="form-control" value="{{ $module->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <div class="card">
                                
                                <div class="card-body">
                                    <div class="swiper" style="height: 100vh;">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-wrapper">
                                            <!-- Slides -->
                            
                                            @forelse ($module->slidersModules as $slider)
                                            <h3 class="title my-2">{{ $slider->name }}</h3>

                                                @foreach (\App\Models\SliderImage::where('slider_id', $slider->id)->get() as $image)
                                                    <div class="swiper-slide">
                                                        <img src="{{ url($image->image) }}" class="img-fluid w-100"
                                                            style="height: 100%; object-fit: content;" alt="Responsive image">
                                                    </div>
                                                @endforeach
                            
                                                @foreach (\App\Models\SliderVideo::where('slider_id', $slider->id)->get() as $video)
                                                    <div class="swiper-slide">
                                                        <video class="w-100" style="height: 100%" controls>
                                                            <source src="{{ url($video->videos) }}">
                                                        </video>
                                                    </div>
                                                @endforeach
                                            @empty
                                                <h5 class="text-center mx-auto mt-5">Aucun contenu pour l'instant!</h5>
                                            @endforelse
                                        </div>
                                    </div>
                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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

