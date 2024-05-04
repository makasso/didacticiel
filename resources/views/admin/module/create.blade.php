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
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.module.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Cours</label>
                                                <select required class="form-control" name="course_id">
                                                    <option value="">--Sélectionnez le cours--</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}"> {{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('course_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nom</label>
                                                <input type="text" name="name" class="form-control">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nombre d'essais</label>
                                                <input type="number" min="1" id="attempt" name="attempt" class="form-control">
                                                @error('attempt')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group d-flex align-items-center col-md-6">
                                                <div class="custom-control pt-4 custom-checkbox custom-checkbox-color custom-control-inline">
                                                    <input type="checkbox" class="custom-control-input" name="status" id="status">
                                                    <label class="custom-control-label" for="status">Statut</label>
                                                 </div>
                                                <div class="pt-2 pb-2"></div>
                                                @error('status')
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
