@extends('layouts.frontend')

@section('title')
    {{ $course->name . '  | ' }} {{ $module->name }}
@endsection
@push('styles')
    <style>
        .swiper-pagination-bullet-active {
            background: #74C69D;
        }
    </style>
@endpush
@include('frontend.module.modal-form')
@section('content')
    <div class="container-fluid">


        <div class="swiper" style="height: 100vh;">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->

                @forelse ($module->slidersModules as $slider)
                    @foreach (\App\Models\SliderImage::where('slider_id', $slider->id)->get() as $image)
                        <div class="swiper-slide">
                            <img src="{{ url($image->image) }}" class="img-fluid w-100"
                                style="height: 100%; object-fit: content;" alt="Responsive image">
                        </div>
                    @endforeach

                    @foreach (\App\Models\SliderVideo::where('slider_id', $slider->id)->get() as $video)
                        <div class="swiper-slide">
                            <video class="w-100" style="height: 100%" controls>
                                <source src="{{ url($video->videos) }}">
                            </video>
                        </div>
                    @endforeach

                    <div class="swiper-slide">
                        <div class="d-flex align-items-center justify-content-start pt-1 px-2 bg-white h-100 w-100">
                            <a href="#" data-toggle="modal" data-target="#quizModule" class="btn btn-secondary">Passer
                                un quiz</a>

                        </div>
                    </div>
                @empty
                    <h5 class="text-center mx-auto mt-5">Aucun contenu pour l'instant!</h5>
                @endforelse
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>



    </div>
@endsection

@push('scripts')
    <script>
        var swiper = new Swiper(".swiper", {
            direction: "vertical",
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            mousewheel: {
                invert: false,
            },
            autoHeight: true,
            effect: 'slide',
        });
    </script>

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
