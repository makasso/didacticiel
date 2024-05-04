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
    {{ \App\Models\Examen::where('id', $examen)->first()->name }}
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if (count($questions) > 0)
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title quiz-question"></h4>
                                <small>Cliquer sur la réponse pour la sélectionner. <b>NB:</b> Faites attention vous ne pourrez plus changer votre réponse!</small>
                            </div>
                            <span class="status font-weight-bold"></span>
                        </div>
                        <div class="card-body">

                            <div class="row align-items-center answers-box">

                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <button type="button" class="btn d-none btn-primary mr-2 next-question">Suivant</button>
                                <form method="POST" id="formCompleteExamen" class="inline" action="{{ route('student.complete-examen', ['copy_link' => $course->copy_link, 'examen_id' => $examen]) }}">
                                    @csrf
                                    <input type="hidden" name="marks" id="marks" value="">
                                    <input type="hidden" name="examen_id" id="examen_id" value="{{ $examen }}">
                                    <input type="hidden" name="number_questions" id="number_questions" value="">
                                    <button type="submit" class="btn btn-secondary d-none btn-finish">Terminer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <h5 class="text-center">Pas de questions pour l'instant!</h5>
                @endif
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            Swal.fire({
                title: 'Bienvenue à l\'examen!',
                html: '<p>Vous allez passer un examen, pour le réussir il faut avoir au moins 70% de bonnes réponses.</p><strong>Bonne chance😊!</strong>',
                icon: 'info',
                confirmButtonColor: '#74C69D',
            })
            var score = 0;
            $.ajax({
                url: "{{ route('student.getExamen', $course->copy_link) }}",
                type: "GET",
                data: {examen_id: '{{ $examen }}'},
                success: function(data) {
                    var questions;
                    questions = data.data

                    console.log(questions);

                    var idx = 1;
                    var questionsCount = Object.keys(questions).length;
                    var selected = false;

                    var answersBox = document.querySelector('.answers-box');
                    $('.status').text(`${idx}/${questionsCount}`)

                    $('.quiz-question').text(questions[idx].question);

                    console.log(questions[idx].answers)

                    questions[idx].answers.forEach(answer => {
                        answersBox.innerHTML += `<div class="form-group col-md-6">
                                <div class="py-3 px-2 bg-light rounded answer" data-correct="${answer.is_correct}">
                                    <span>${answer.answer}</span>
                                </div>
                            </div>`;
                    });

                    // select the answer
                    $(document).on('click', '.answer', function(e) {
                        if (!selected) {
                            var isCorrect = $(this).data('correct');
                            $(this).removeClass('bg-light');
                            $(this).addClass('bg-primary');
                            

                            if (isCorrect == 1) {
                                score += 1;
                                
                            } else {
                                
                            }
                        }
                        selected = true;
                        $('.next-question').removeClass('d-none');
                    });

                    function getNextQuestion() {
                        selected = false;
                        if (idx >= questionsCount) {
                            $('.next-question').addClass('d-none');
                            $('.btn-finish').removeClass('d-none');

                            Toast.fire({
                                html: 'Vous avez terminé l\'examen cliquer sur <b>"Terminer"</b> pour voir votre résultat',
                                icon: 'success',
                                timerProgressBar: true,
                            })
                        } else {
                            idx += 1;
                            $('.status').text(`${idx}/${questionsCount}`);
                            getQuestion();
                            $('.next-question').addClass('d-none');
                        }
                    }

                    function getQuestion() {
                        $('.quiz-question').text(questions[idx].question);
                        $('.answers-box').empty();
                        questions[idx].answers.forEach(answer => {
                            answersBox.innerHTML += `<div class="form-group col-md-6">
                                <div class="py-3 px-2 bg-light rounded answer" data-correct="${answer.is_correct}">
                                    <span>${answer.answer}</span>
                                </div>
                            </div>`;
                        });
                    }
                    $('.next-question').click(function() {
                        getNextQuestion();
                    });

                    $('.btn-finish').on('click', function() {
                        $('#marks').val(score);
                        $('#number_questions').val(questionsCount);
                    });
                }
            });

        });
    </script>
@endpush
