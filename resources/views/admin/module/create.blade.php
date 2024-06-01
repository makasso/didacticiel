@extends('layouts.app')
@section('title')
    Créer un module
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
                                        <h4 class="card-title">Créer un module</h4>
                                    </div>
                                    <a href="{{ route('admin.module.index') }}" class="btn btn-primary float-end">Retour</a>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.module.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="course_id">Cours</label>
                                                <div class="input-group mb-4">
                                                    <select class="form-control" name="course_id" id="course_id">
                                                        <option selected>--Selectionner Cours--</option>
                                                        @foreach ($categories as $category)
                                                            <optgroup label="{{ $category->name }}">
                                                                @foreach ($category->coursesCategories as $course)
                                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                        @endforeach
                                                            </optgroup>
                                                            
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                       <label class="input-group-text" for="course_id">Cours</label>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nom</label>
                                                <input type="text" name="name" class="form-control">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                           
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Créer</button>
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
