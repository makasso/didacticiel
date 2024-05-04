@extends('layouts.auth')
@section('title')
    Connexion Etudiant
@endsection
@section('content')
    <div class="p-2">
       
       <div class="d-flex align-items-center justify-content-between">
        <h2 class="mb-4 text-white">Connectez-vous</h2>
       </div>
        <form action="{{ route('login-student') }}" method="POST">
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
                        <label class="text-white">Nom</label>
                        <input class="form-control" id="lastname" type="text" placeholder="" name="lastname" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="text-white">Prénom</label>
                        <input class="form-control" id="firstname" type="text" placeholder="" name="firstname" required>
                    </div>
                </div>

            </div>
           <div class="row">
                <div class="col-md-6"> <button id="loginBtn" type="submit" class="btn btn-lg btn-white">Connexion</button></div>
           </div>

        </form>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#loginBtn').attr('disabled', true);

            $('#email').blur(function() {
                var email = $(this).val();
                $.ajax({
                    url: '{{ route("student.get-name") }}',
                    type: 'GET',
                    data: {email: email},
                    success: function(response) {
                        if (response.firstname) {
                            console.log(response);
                            $('#firstname').val(response.firstname);
                            $('#lastname').val(response.lastname);
                        } else {
                            console.log(response);
                            $('#firstname').val('');
                            $('#firstname').attr('disabled', false);

                            $('#lastname').val('');
                            $('#lastname').attr('disabled', false);
                        }
                    },
                });
                $('#loginBtn').attr('disabled', false);
            });
        });
    </script>
@endpush