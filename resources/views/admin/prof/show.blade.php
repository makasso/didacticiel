@extends('layouts.app')
@section('title')
    Professeur {{ $user->name }}
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
                                        <h4 class="card-title">Professeur {{ $user->name }} </h4>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.prof.index') }}"
                                            class="btn btn-primary float-end">Retour</a>
                                        <a href="{{ route('admin.prof.edit', $user->id) }}"
                                            class="btn btn-secondary">Modifier</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="">Nom</label>
                                            <input disabled type="text" name="name" value="{{ $user->name }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Email</label>
                                            <input disabled type="text" value="{{ $user->email }}" name="email"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="expiry-date">Date d'invalidité</label>
                                            <input disabled type="date" id="expiry-date" value="{{ $user->expiry_date }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="category_id">Société</label>
                                            <input disabled type="text"
                                                value="{{ $user->companyUser->name ?? 'Aucune société' }}" class="form-control">
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
