@extends('layouts.app')
@section('title')
    Catégorie {{$category->name}}
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
                                        <h4 class="card-title">Catégorie {{ $category->name }}</h4>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.category.index') }}" class="btn btn-primary float-end">Retour</a>
                                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-secondary">Modifier</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="form-group col-sm-12">
                                                <label for="name">Nom:</label>
                                                <input disabled type="text" class="form-control" id="name" name="name"
                                                    value="{{ $category->name }}">
                                                <div class="pt-2 pb-2"></div>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="email">Description:</label>
                                                <textarea disabled class="form-control" name="description" id="description">{{ $category->description }}</textarea>
                                                <div class="pt-2 pb-2"></div>
                                                @error('description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
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
