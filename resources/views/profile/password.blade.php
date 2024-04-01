@extends('layouts.app')
@section('title')
    Modifier votre mot de passe
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
                                        <h4 class="card-title">Modifier votre mot de passe</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert">
                                            <div class="iq-alert-icon">
                                                <i class="ri-check-fill"></i>
                                            </div>
                                            <div class="iq-alert-text">{{ session('success') }}</div>
                                        </div>
                                    @elseif(session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            <div class="iq-alert-icon">
                                                <i class="ri-information-fill"></i>
                                            </div>
                                            <div class="iq-alert-text">{{ session('error') }}</div>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('admin.profile.password') }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row align-items-center">
                                            <div class="form-group col-sm-6">
                                                <label for="current_password">Mot de passe actuel:</label>
                                                <input type="password"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    id="current_password" name="current_password" required>
                                                @error('current_password')
                                                    <small class="text-danger pt-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="password">Nouveau mot de passe:</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" required>
                                                @error('password')
                                                    <small class="text-danger pt-2">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="password_confirmation">Nouveau mot de passe:</label>
                                                <input type="password" class="form-control" id="password_confirmation"
                                                    name="password_confirmation" required>
                                                <div class="pt-2 pb-2"></div>
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
