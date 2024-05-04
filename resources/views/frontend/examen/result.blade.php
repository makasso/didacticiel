@extends('layouts.frontend')

@push('styles')
    <style>
        .answer {
            cursor: pointer;
        }

        .answer-disabled {
            cursor: not-allowed;
        }
    </style>
@endpush

@section('title')
    {{ $examen->name }}
@endsection


@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center">
                                @if ($percentage >= 70)
                                   <h5 class="text-center">Félicitations vous avez donné {{ intval($percentage) }}% de bonne réponse 😊! </h5>
                                   <a href="{{ route('student.certificate', ['examen_id' => $examen->id, 'student_id' => $student->id, 'certificate_id' => $examen_attempt_certificate]) }}">Générer votre certificat</a>
                                @else
                                    <h5 class="text-center">Vous n'avez malheureusement donné que {{ intval($percentage) }}% de bonne réponse 😞!</h5>    
                                    <a href="{{ route('student.frontendCourse', $course->copy_link) }}">Revenir au cours</a>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        
    </script>
@endpush
