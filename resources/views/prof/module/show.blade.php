@extends('layouts.app')
@section('title')
    Module {{ $module->name }}
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
                                        <h4 class="card-title">Module {{ $module->name }}</h4>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('prof.course.get-modules', $module->course_id) }}"
                                            class="btn btn-primary float-end">Retour</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Cours</label>
                                            <input disabled type="text" class="form-control"
                                                value="{{ $module->coursesModules->name }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nom</label>
                                            <input disabled type="text" class="form-control" value="{{ $module->name }}">
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
