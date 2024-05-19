@extends('layouts.app')
@section('title')
    Modifier Professeur
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
                                        <h4 class="card-title">Modifier Professeur</h4>
                                    </div>
                                    <a href="{{ route('admin.prof.index') }}" class="btn btn-primary float-end">Retour</a>

                                </div>
                                <div class="card-body">
                                    <form action="{{ url('admin/prof/' . $user->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="">Nom</label>
                                                <input type="text" name="name" value="{{ $user->name }}"
                                                    class="form-control">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Email</label>
                                                <input type="text" value="{{ $user->email }}" name="email"
                                                    class="form-control">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="expiry-date">{{ __('Expiry Date') }}</label>
                                                <input type="date" id="expiry-date" value="{{ $user->expiry_date }}"
                                                    class="form-control datepicker @error('expiry_date') is-invalid @enderror"
                                                    name="expiry_date" value="{{ old('expiry_date') }}" required>

                                                @error('expiry_date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="category_id">Société</label>
                                                <div class="input-group mb-4">
                                                    <select class="form-control" name="company_id" id="company_id">
                                                        <option selected>--Selectionner une société--</option>
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}" {{ isset($user->companyUser) && $company->id == $user->companyUser->id ? 'selected' : '' }}>{{ $company->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <label class="input-group-text" for="company_id">Société</label>
                                                    </div>
                                                </div>
                                                @error('company_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <button type="submit" class="btn btn-primary float-end">Modifier</button>
                                            </div>
                                        </div>
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
