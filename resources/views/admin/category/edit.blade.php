@extends('layouts.app')
@section('title')
    Modifier catégorie
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
                                        <h4 class="card-title">Modifier catégorie</h4>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.category.update', $category) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row align-items-center">
                                            <div class="form-group col-sm-12">
                                                <label for="name">Nom:</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $category->name }}">
                                                <div class="pt-2 pb-2"></div>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label for="email">Description:</label>
                                                <textarea class="form-control" name="description" id="description">{{ $category->description }}</textarea>
                                                <div class="pt-2 pb-2"></div>
                                                @error('description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="image">
                                                    <label class="custom-file-label" for="image">Choisissez une image</label>
                                                 </div>
                                                @error('image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="custom-control custom-checkbox custom-checkbox-color custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="status" id="status" {{ $category->status == '1' ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="status">Status</label>
                                                 </div>
                                                <div class="pt-2 pb-2"></div>
                                                @error('status')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
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
