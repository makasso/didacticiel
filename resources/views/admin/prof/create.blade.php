@extends('layouts.app')
@section('title')
    Créer Professeur
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
                                        <h4 class="card-title">Créer Professeur</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.prof.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="">Nom</label>
                                                <input type="text" name="name" class="form-control">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Email</label>
                                                <input type="text" name="email" class="form-control">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="expiry-date">Date d'invalidité</label>
                                                <input type="date" id="expiry-date"
                                                    class="form-control datepicker @error('expiry_date') is-invalid @enderror"
                                                    name="expiry_date" value="{{ old('expiry_date') }}" required>

                                                @error('expiry_date')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Societé</label>
                                                <input type="text" name="company" class="form-control">
                                                @error('company')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="">Spécialité</label>
                                                <input type="text" name="speciality" class="form-control">
                                                @error('speciality')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="password">Mot de passe</label>
                                                <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                
                                                @error('password')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                
                                            <div class="col-md-6 mb-3">
                                                <label for="password-confirmation">Confirmation mot de passe</label>
                                                <input id="password-confirmation" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                
                                                @error('password_confirmation')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <button type="submit" class="btn btn-primary float-end">Créer</button>
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
