@extends('layouts.auth')
@section('title')
    Connexion
@endsection
@section('content')
    <div class="p-3">
        <h2 class="mb-4 text-white">Connectez-vous</h2>
        <form action="{{ route('user.login') }}" method="POST">
            @csrf
            @if (Session::has('error'))
                <h6 class="alert alert-danger">{{ Session::get('error') }}</h6>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="text-white">Email</label>
                        <input class="form-control" id="email" type="email" placeholder="" name="email" required>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="text-white">Mot de Passe</label>
                        <input class="form-control" id="password" type="password" placeholder="" name="password" required>
                    </div>
                </div>
               
            </div>
           <div class="row">
                <div class="col-md-6"> <button id="loginBtn" type="submit" class="btn btn-lg btn-white">Connexion</button></div>
           </div>

        </form>

    </div>
@endsection
