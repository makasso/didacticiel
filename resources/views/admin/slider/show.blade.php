@extends('layouts.app')
@section('title')
    Slide {{ $slider->name }}
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
                                        <h4 class="card-title">Modifier Slide</h4>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.slider.index') }}" class="btn btn-primary float-end">Retour</a>
                                        <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-secondary">Modifier</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="home-tab" data-toggle="tab"
                                                    data-target="#home-tab-pane" type="button" role="tab"
                                                    aria-controls="home-tab-pane" aria-selected="true">
                                                    Accueil
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="details-tab" data-toggle="tab"
                                                    data-target="#details-tab-pane" type="button" role="tab"
                                                    aria-controls="details-tab-pane" aria-selected="false">
                                                    Slides Vidéos
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="image-tab" data-toggle="tab"
                                                    data-target="#image-tab-pane" type="button" role="tab"
                                                    aria-controls="image-tab-pane" aria-selected="false">
                                                    Slides Images
                                                </button>
                                            </li>

                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane"
                                                role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                                <div class="form-group">
                                                    <label>Nom Module</label>
                                                    <input disabled type="text" name="" id=""  value="{{ $slider->modulesSliders->name }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nom Slide</label>
                                                    <input disabled type="text" name="name" value="{{ $slider->name }}"
                                                        class="form-control">
                                                </div>

                                                
                                            </div>
                                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                                aria-labelledby="details-tab" tabindex="0">
                                                <div class="mt-2">
                                                    @if ($slider->sliderVideos)
                                                        <div class="row">
                                                            @foreach ($slider->sliderVideos as $videos)
                                                                <div class="col-md-2"
                                                                    class="embed-responsive embed-responsive-16by9">
                                                                    <video width="320" height="240" autoplay muted>
                                                                        <source src="{{ asset($videos->videos) }}">
                                                                    </video>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <h5>Aucune vidéo ajoutée</h5>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                                aria-labelledby="image-tab" tabindex="0">
                                                <div class="mt-2">
                                                    @if ($slider->sliderImages)
                                                        <div class="row">
                                                            @foreach ($slider->sliderImages as $image)
                                                                <div class="col-md-2">
                                                                    <img src="{{ asset($image->image) }}"
                                                                        style="width: 80px; height: 80px;"
                                                                        class="me-4 border" alt="Img">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <h5>Aucune image ajouté</h5>
                                                    @endif
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
    </div>
@endsection
