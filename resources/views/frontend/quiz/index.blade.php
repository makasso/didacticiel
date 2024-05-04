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
    {{--  --}}
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if (count($questions) > 0)
                    @if ($countModuleAttempts >= 2)
                        <h5 class="text-center">Vous avez déjà passé un quiz pour ce module au moins deux fois!</h5>
                    @else
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
                                    <button type="button"
                                        class="btn d-none btn-primary mr-2 next-question">Suivant</button>
                                    <form method="POST" id="formCompleteQuiz" class="inline"
                                        action="{{ route('student.frontendModule.completeQuiz', $module->id) }}">
                                        @csrf
                                        <input type="hidden" name="marks" id="marks" value="">
                                        <button type="submit" class="btn btn-secondary d-none btn-finish">Terminer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
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
            var score = 0;
            $.ajax({
                url: "{{ route('student.frontendModule.getQuiz', $module->id) }}",
                type: "GET",
                data: {},
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
                            $('.answer').removeClass('bg-light');
                            $('div[data-correct="1"]').addClass('bg-success');
                            $('div[data-correct="0"]').addClass('bg-danger');

                            if (isCorrect == 1) {
                                score += 1;
                                Toast.fire({
                                    title: 'Bonne réponse!',
                                    icon: 'success'
                                });
                            } else {
                                Toast.fire({
                                    title: 'Mauvaise réponse!',
                                    icon: 'error'
                                });
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
                }
            });

        });
    </script>
@endpush
