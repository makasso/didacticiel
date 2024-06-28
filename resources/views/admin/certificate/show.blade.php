@extends('layouts.app')
@section('title')
    Certificat {{ $certificate->certificate_id }}
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
                                        <h4 class="card-title">Certificat {{ $certificate->name }}</h4>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.certificate') }}" class="btn btn-primary float-end">Retour</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="form-group col-md-6">
                                                <label for="name">Matricule Certificat</label>
                                                <input disabled type="text" class="form-control" value="{{ $certificate->certificate_id }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Etudiant</label>
                                                <input disabled type="text" class="form-control" value="{{ $certificate->student->firstname . ' ' . $certificate->student->lastname }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Cours</label>
                                                <input disabled type="text" class="form-control" value="{{ $certificate->examen->coursesExamens->name }}">
                                            </div>
                                           
                                            <div class="form-group col-md-6">
                                                <label for="name">Date de délivrance</label>
                                                <input disabled type="text" class="form-control" value="{{ $certificate->created_at->format('Y-m-d') }}">
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
