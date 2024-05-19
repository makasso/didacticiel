@extends('layouts.app')
@section('title')
    Modifier Cours
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
                                        <h4 class="card-title">Modifier Cours</h4>
                                    </div>
                                    <a href="{{ route('admin.course.index') }}" class="btn btn-primary float-end">Retour</a>

                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.course.update', $course->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <div class="row align-items-center">
                                            <div class="form-group col-md-6">
                                                <label for="category_id">Catégorie</label>
                                                <div class="input-group mb-4">
                                                    <select class="form-control" name="category_id" id="category_id"
                                                        required>
                                                        <option selected>--Selectionner une categorie--</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $course->category_id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <label class="input-group-text" for="category_id">Catégories</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="">Nom</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $course->name }}">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                                <div class="pt-2 pb-2"></div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2">Modifier</button>
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
