@extends('layouts.app')
@section('title')
    Créer un slide
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
                                        <h4 class="card-title">Créer un slide</h4>
                                    </div>
                                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary float-end">Retour</a>

                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.slider.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
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
                                                    Slide Vidéo
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="image-tab" data-toggle="tab"
                                                    data-target="#image-tab-pane" type="button" role="tab"
                                                    aria-controls="image-tab-pane" aria-selected="false">
                                                    Slide Image
                                                </button>
                                            </li>

                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane"
                                                role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                                <div class="form-group">
                                                    <label>Nom Module</label>
                                                    <select name="module_id" class="form-control">
                                                        @foreach ($categories as $category)
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach ($category->coursesCategories as $course)
                                                            <optgroup label="{{ $course->name }}">
                                                                @foreach ($course->modulesCourses as $module)
                                                                    <option value="{{ $module->id }}">{{ $module->name }}
                                                                    </option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                        </optgroup>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nom Slide</label>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                                aria-labelledby="details-tab" tabindex="0">
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" multiple
                                                            name="videos[]" id="image">
                                                        <label class="custom-file-label" for="image">Sélectionner
                                                            vidéos</label>
                                                    </div>
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
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary d-block m-1">Créer</button>
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
