@extends('layouts.app')
@section('title')
    Modifier Slide
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
                                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary float-end">Retour</a>

                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.slider.update', $slider) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
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
                                                    <select name="module_id" class="form-control">

                                                        @foreach ($modules as $module)
                                                            <option value="{{ $module->id }}"
                                                                {{ $module->id == $slider->module_id ? 'selected' : '' }}>
                                                                {{ $module->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nom Slide</label>
                                                    <input type="text" name="name" value="{{ $slider->name }}"
                                                        class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="description" class="form-control" rows="4">{{ $slider->description }}</textarea>
                                                </div>
                                                <div class="form-group d-flex align-items-center col-md-6">
                                                    <div class="custom-control pt-4 custom-checkbox custom-checkbox-color custom-control-inline">
                                                        <input type="checkbox" class="custom-control-input" name="is_introduction" id="is_introduction" {{ $slider->is_introduction == '1' ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="is_introduction">Introduction (Le premier slide de présentation du module)</label>
                                                     </div>
                                                    <div class="pt-2 pb-2"></div>
                                                    @error('is_introduction')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                                aria-labelledby="details-tab" tabindex="0">
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" multiple
                                                            name="videos[]" id="videos">
                                                        <label class="custom-file-label" for="videos">Sélectionner
                                                            vidéos</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    @if ($slider->sliderVideos)
                                                        <div class="row">
                                                            @foreach ($slider->sliderVideos as $videos)
                                                                <div class="col-md-2"
                                                                    class="embed-responsive embed-responsive-16by9">
                                                                    <video width="320" height="240" autoplay muted>
                                                                        <source src="{{ asset($videos->videos) }}">
                                                                    </video>
                                                                    <a href="{{ url('admin/slider-videos/' . $videos->id . '/delete') }}"
                                                                        class="d-block">Supprimer</a>
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
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" multiple
                                                            name="image[]" id="image">
                                                        <label class="custom-file-label" for="image">Sélectionner
                                                            images</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    @if ($slider->sliderImages)
                                                        <div class="row">
                                                            @foreach ($slider->sliderImages as $image)
                                                                <div class="col-md-2">
                                                                    <img src="{{ asset($image->image) }}"
                                                                        style="width: 80px; height: 80px;"
                                                                        class="me-4 border" alt="Img">
                                                                    <a href="{{ url('admin/slider-image/' . $image->id . '/delete') }}"
                                                                        class="d-block">Supprimer</a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <h5>Aucune image ajouté</h5>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary d-block m-1">Modifier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
