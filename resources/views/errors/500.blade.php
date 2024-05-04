@extends('layouts.error')
@section('title')500 @endsection
@section('content')
<div class="row no-gutters height-self-center">
    <div class="col-sm-12 text-center align-self-center">
        <div class="iq-error position-relative">
            <img src="{{asset('assets/images/error/500.png')}}" class="img-fluid iq-error-img" alt="">
            <h2 class="mb-0 mt-4">Oops! Erreur Serveur.</h2>
            <p>Il s'emblerait que le serveur rencontre un problème.</p>
            <a class="btn btn-primary d-inline-flex align-items-center mt-3" href="{{ url('/') }}"><i
                class="ri-home-4-line"></i>Revenir à l'accueil</a>
        </div>
    </div>
</div>
@endsection
