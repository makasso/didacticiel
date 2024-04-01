@extends('layouts.app')
@section('title')
    Créer une catégorie
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
                                        <h4 class="card-title">Créer une catégorie</h4>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.course.store') }}">
                                        @csrf
                                        <div class="row align-items-center">
                                            <div class="form-group col-md-6">
                                                <div class="input-group mb-4">
                                                    <select class="custom-select" name="category_id" id="inputGroupSelect02">
                                                        <option selected>--Selectionner une categorie--</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                       <label class="input-group-text" for="inputGroupSelect02">Catégories</label>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group mb-4">
                                                    <select class="custom-select" name="user_id" id="inputGroupSelect02">
                                                        <option label="--Selectionner un professeur--" selected></option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                       <label class="input-group-text" for="inputGroupSelect02">Profs</label>
                                                    </div>
                                                 </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Nom</label>
                                                <input type="text" name="name" class="form-control">
                                                @error('name')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                                <div class="pt-2 pb-2"></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Durée</label>
                                                <input type="time" name="duree" class="form-control">
                                                @error('name')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                                <div class="pt-2 pb-2"></div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">Nombre de module</label>
                                                <input type="number" min="1" name="number_module" class="form-control">
                                                @error('name')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                                <div class="pt-2 pb-2"></div>
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
