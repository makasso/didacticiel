@extends('layouts.error')
@section('title')401 @endsection
@section('content')
<div class="row no-gutters height-self-center">
    <div class="col-sm-12 text-center align-self-center">
        <div class="iq-error position-relative">
            <img src="{{asset('assets/images/error/404.png')}}" class="img-fluid iq-error-img" alt="">
            <h2 class="mb-0 mt-4">Oops! Page non valide.</h2>
            <p>Cette page n'est pas valide.</p>
            @auth()
                @if(auth()->user()->role_as == '0')
                    <a class="btn btn-primary d-inline-flex align-items-center mt-3" href="{{ url('/') }}"><i
                            class="ri-home-4-line"></i>Revenir à l'accueil</a>
                @else
                    <a class="btn btn-primary d-inline-flex align-items-center mt-3" href="{{ route('prof.dashboard') }}"><i
                            class="ri-home-4-line"></i>Revenir à l'accueil</a>
                @endif

            @endauth
            @guest()
                <a class="btn btn-primary d-inline-flex align-items-center mt-3" href="{{ url('/login') }}"><i
                        class="ri-home-4-line"></i>Revenir à l'accueil</a>
            @endguest
        </div>
    </div>
</div>
@endsection
