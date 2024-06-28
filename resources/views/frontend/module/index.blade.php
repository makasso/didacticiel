@php use App\Models\SliderImage; @endphp
@php use App\Models\SliderVideo; @endphp
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
                    @foreach (SliderImage::where('slider_id', $slider->id)->get() as $image)
                        <div class="swiper-slide">
                            <img src="{{ url($image->image) }}" class="img-fluid w-100"
                                 style="height: 100%; object-fit: content;" alt="Responsive image">
                        </div>
                    @endforeach

                    @foreach (SliderVideo::where('slider_id', $slider->id)->get() as $video)
                        <div class="swiper-slide">
                            <video class="video-js"
                                   controls
                                   preload="auto"
                                   width="1280"
                                   height="685"
                                   poster="{{ url(App\Models\SliderImage::where('slider_id', $slider->id)->first()->image) }}"
                                   data-setup="{}">
                                <source src="{{ url($video->videos) }}">
                                <p class="vjs-no-js">
                                    Pour regarder cette vidéo, activez JavaScript et considérez mettre à jour votre navigateur web
                                    <a href="https://videojs.com/html5-video-support/" target="_blank" rel="noopener">support de HTML5 video</a>
                                </p>
                            </video>
                        </div>
                    @endforeach

                @empty
                    <h5 class="text-center mx-auto mt-5">Aucun contenu pour l'instant!</h5>
                @endforelse
                <div class="swiper-slide ">
                    <div
                        class="d-flex bg-white flex-column align-items-center justify-content-center pt-1 px-2 h-100 w-100">
                        <div class="confetti-container">
                            <div class="confetti bg-primary"></div>
                            <div class="confetti bg-secondary"></div>
                            <div class="confetti bg-light"></div>
                            <div class="confetti bg-purple"></div>
                            <div class="confetti bg-orange"></div>
                            <div class="confetti bg-danger"></div>
                            <div class="confetti bg-gradient-blue"></div>
                            <div class="confetti bg-gradient-danger"></div>
                            <div class="confetti bg-dark"></div>
                            <div class="confetti bg-gray"></div>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#quizModule" class="btn btn-lg bg-secondary" style="position: fixed; z-index: 99999;">Passer
                            un quiz</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
@endsection

@push('styles')
    <style>
        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .confetti {
            position: absolute;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            z-index: 1;
            animation: fall 6s ease-in-out infinite;
        }

        /* Animation des confettis */
        @keyframes fall {
            0% {
                transform: translateY(-100vh) rotateZ(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotateZ(720deg);
                opacity: 0;
            }
        }

        /* Positionnement aléatoire initial des confettis */
        .confetti:nth-child(1) {
            left: 5%;
            animation-delay: 0s;
        }

        .confetti:nth-child(2) {
            left: 15%;
            animation-delay: 1s;
        }

        .confetti:nth-child(3) {
            left: 30%;
            animation-delay: 2.5s;
        }

        .confetti:nth-child(4) {
            left: 40%;
            animation-delay: 0.5s;
        }

        .confetti:nth-child(5) {
            left: 50%;
            animation-delay: 1s;
        }
        .confetti:nth-child(6) {
            left: 60%;
            animation-delay: 1.5s;
        }
        .confetti:nth-child(7) {
            left: 70%;
            animation-delay: 1.1s;
        }
        .confetti:nth-child(8) {
            left: 80%;
            animation-delay: 2.2s;
        }
        .confetti:nth-child(9) {
            left: 90%;
            animation-delay: 1.5s;
        }
        .confetti:nth-child(10) {
            left: 100%;
            animation-delay: 2s;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper", {
            direction: "vertical",
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
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
        $(document).ready(function () {
            var score = 0;
            $.ajax({
                url: "{{ route('student.frontendModule.getQuiz', $module->id) }}",
                type: "GET",
                data: {},
                success: function (data) {
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
                    $(document).on('click', '.answer', function (e) {
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

                    $('.next-question').click(function () {
                        getNextQuestion();
                    });
                }
            });

        });
    </script>
@endpush
