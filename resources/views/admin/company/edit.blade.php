@extends('layouts.app')
@section('title')
    Modifier société
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
                                        <h4 class="card-title">Modifier société</h4>
                                    </div>
                                    <a href="{{ route('admin.company.index') }}" class="btn btn-primary float-end">Retour</a>

                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.company.update', $company->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row align-items-center">
                                            <div class="form-group col-md-6">
                                                <label for="name">Nom:</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $company->name }}">
                                                <div class="pt-2 pb-2"></div>
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
