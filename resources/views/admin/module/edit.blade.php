@extends('layouts.app')
@section('title')
    Modifier module
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
                                        <h4 class="card-title">Modifier module</h4>
                                    </div>
                                    <a href="{{ route('admin.module.index') }}" class="btn btn-primary float-end">Retour</a>
                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.module.update', $module->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Cours</label>
                                                <select required class="form-control" name="course_id">
                                                    <option value="">--Sélectionnez le cours--</option>
                                                    @foreach ($courses as $course)
                                                            <option value="{{ $course->id }}"
                                                                {{ $course->id == $module->course_id ? 'selected' : '' }}>
                                                                {{ $course->name }}
                                                            </option>
                                                        @endforeach
                                                </select>
                                                @error('course_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Nom</label>
                                                <input type="text" name="name" class="form-control" value="{{$module->name}}">
                                                @error('name')
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
