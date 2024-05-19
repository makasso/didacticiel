@extends('layouts.app')
@section('title')
    Cours {{  $course->name}}
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
                                        <h4 class="card-title">Cours {{ $course->name }}</h4>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.course.index') }}" class="btn btn-primary float-end">Retour</a>
                                        <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-secondary">Modifier</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="form-group col-md-6">
                                                <label for="category_id">Catégorie</label>
                                                <input disabled class="form-control" type="text" name="" id="" value="{{ $course->categoriesCourses->name }}">
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="">Nom</label>
                                                <input disabled type="text" name="name" class="form-control" value="{{ $course->name }}">
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
