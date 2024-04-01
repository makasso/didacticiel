@extends('layouts.auth')
@section('title')
    Login
@endsection
@section('content')
    <div class="p-3">
        <h2 class="mb-2 text-white">{{ env('APP_NAME') }}</h2>
        <p>Se Connecter</p>
        <form action="{{ route('user.login') }}" method="POST">
            @csrf
            @if (Session::has('error'))
                <h6 class="alert alert-danger">{{ Session::get('error') }}</h6>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="floating-label form-group">
                        <input class="floating-input form-control" type="email" placeholder="" name="email" required>
                        <label>Email</label>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="floating-label form-group">
                        <input class="floating-input form-control" type="password" placeholder="" name="password" required>
                        <label>Mot de passe</label>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-white">Connexion</button>

        </form>

    </div>
@endsection
