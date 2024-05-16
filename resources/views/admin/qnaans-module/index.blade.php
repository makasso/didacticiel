@extends('layouts.app')
@section('title')
    Liste des questions
@endsection
@include('admin.qnaans-module.modal-form')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des questions
                            </h4>
                        </div>
                        <a href="#" class="btn btn-primary float-end" data-toggle="modal"
                            data-target="#addQuizModal">Ajouter Une Question</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>N°</th>
                                        <th>Questions</th>
                                        <th>Cours</th>
                                        <th>Réponses</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($questions) > 0)
                                        @foreach ($questions as $question)
                                            <tr>
                                                <td>{{ $question->id }}</td>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ \App\Models\Course::where('id', $question->course_id)->first()->name ?? 'Aucun Cours' }}</td>
                                                <td>
                                                    <a href="#" class="ansButton" data-id="{{ $question->id }}"
                                                        data-toggle="modal" data-target="#showAnsModal"
                                                        style="text-decoration: none">Afficher réponses</a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success editButton" data-id="{{ $question->id }}"
                                                        data-toggle="modal" data-target="#editQnaModal">Modifier</button>
                                                    <a href="{{ route('admin.qnaans-module.deleteQna', $question->id) }}"
                                                        class="btn btn-danger deleteButton" data-confirm-delete="true"
                                                        data-id="{{ $question->id }}" data-toggle="modal"
                                                        data-target="#deleteQnaModal">Supprimer</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Aucune question trouvée!</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            // form submittion
            $("#addQna").submit(function(e) {
                e.preventDefault();

                if ($(".answers").length < 2) {
                    $(".error").text("AJoutez au moins 2 réponses svp!")
                    setTimeout(function() {
                        $(".error").text("");
                    }, 2400);
                } else {

                    var checkIsCorrect = false;

                    for (let i = 0; i < $(".is_correct").length; i++) {

                        if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                            checkIsCorrect = true;
                            $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find(
                                'input').val());

                        }

                    }

                    if (checkIsCorrect) {

                        var formData = $(this).serialize();

                        $.ajax({

                            url: "{{ route('admin.qnaans-module.create') }}",
                            type: "POST",
                            data: formData,
                            success: function(data) {
                                console.log(data);
                                if (data.success == true) {
                                    Toast.fire({
                                        title: data.message,
                                        icon: 'success',

                                    });
                                } else {
                                    Toast.fire({
                                        title: data.message,
                                        icon: 'error',

                                    });
                                }
                                destroyAllModals();
                            }
                        });

                    } else {
                        $(".error").text("Cochez au moins une réponse comme correct!")
                        setTimeout(function() {
                            $(".error").text("");
                        }, 2400);

                    }

                }

            });

            // add answers
            $("#addAnswer").click(function() {

                if ($(".answers").length >= 6) {
                    $(".error").text("Vous pouvez entrer uniquement 6 réponses.")
                    setTimeout(function() {
                        $(".error").text("");
                    }, 2000);
                } else {
                    var html = `
                    <div class="input-group mb-3 mt-2 answers">
                        <input type="radio" name="is_correct" class="is_correct">
                        <div class="col">
                            <input type="text" class="form-control m-input" name="answers[]" required placeholder="Entrer une réponse">
                        </div>
                        <button class="btn btn-danger removeButton">Retirer</button>
                    </div>
                `;
                    $('.addModalAnswers').append(html);
                }

            });

            // remove button
            $(document).on('click', '.removeButton', function() {
                $(this).closest('.answers').remove();
            });

            // show answers code
            $(".ansButton").click(function() {

                var questions = @json($questions);
                var qid = $(this).attr('data-id');

                var html = '';
                // console.log(questions);

                for (let i = 0; i < questions.length; i++) {

                    if (questions[i]['id'] == qid) {

                        var answersLength = questions[i]['answers'].length;
                        for (let j = 0; j < answersLength; j++) {
                            let is_correct = 'Non';
                            if (questions[i]['answers'][j]['is_correct'] == 1) {
                                is_correct = 'Oui';
                            }

                            html += `
                            <tr>
                                <td> ` + (j + i) + `</td>
                                <td> ` + questions[i]['answers'][j]['answer'] + `</td>
                                <td> ` + is_correct + `</td>
                            </tr>

                        `;
                        }

                        break;
                    }

                }
                $(".showAnswers").html(html);

            });

            // edit or update Q&A
            $("#addEditAnswer").click(function() {

                if ($(".editAnswers").length >= 6) {
                    $(".editError").text("You can add maximum 6 answers.")
                    setTimeout(function() {
                        $(".editError").text("");
                    }, 2000);
                } else {
                    var html = `
                    <div class="input-group mb-3 mt-2 editAnswers">
                        <input type="radio" name="is_correct" class="edit_is_correct">
                        <div class="col">
                            <input type="text" class="form-control m-input" name="new_answers[]" required placeholder="Entrer une réponse">
                        </div>
                        <button class="btn btn-danger removeEditButton">Retirer</button>
                    </div>
                `;
                    $('.editModalAnswers').append(html);
                }

            });



            // button edit submittion
            $(".editButton").click(function() {

                var qid = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('admin.qnaans-module.getQnaDetails') }}",
                    type: "GET",
                    data: {
                        qid: qid
                    },
                    success: function(data) {
                        console.log(data);
                        var qna = data.data[0];

                        $("#question_id").val(qna['id']);
                        $("#question").val(qna['question']);


                        var html = '';

                        for (let i = 0; i < qna['answers'].length; i++) {
                            $(".editAnswers").remove();
                            var checked = '';

                            if (qna['answers'][i]['is_correct'] == 1) {
                                checked = 'checked';
                            }

                            html += `
                            <div class="input-group mb-3 mt-2 editAnswers">
                                <input type="radio" name="is_correct" class="edit_is_correct" ` + checked + `>
                                <div class="col">
                                    <input type="text" class="form-control m-input" name="answers[` + qna['answers'][i]
                                ['id'] + `]"
                                    value="` + qna['answers'][i]['answer'] + `" required placeholder="Entrer la réponse">
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-danger removeEditButton removeAnswer" data-id="` + qna[
                                    'answers'][i]['id'] + `">Retirer</button>
                                </div>
                            </div>

                        `;
                            $('.editModalAnswers').append(html);
                        }
                    }
                });

            });

            // update Qna submittion
            $("#editQna").submit(function(e) {
                e.preventDefault();

                if ($(".editAnswers").length < 2) {
                    $(".editError").text("Ajouter au moins 2 réponses.")
                    setTimeout(function() {
                        $(".editError").text("");
                    }, 2000);
                } else {

                    var checkIsCorrect = false;

                    for (let i = 0; i < $(".edit_is_correct").length; i++) {

                        if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
                            checkIsCorrect = true;
                            $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")")
                                .next().find('input').val());

                        }

                    }

                    if (checkIsCorrect) {

                        var formData = $(this).serialize();

                        $.ajax({

                            url: "{{ route('admin.qnaans-module.updateQna') }}",
                            type: "POST",
                            data: formData,
                            success: function(data) {
                                if (data.success == true) {
                                    Toast.fire({
                                        title: data.message,
                                        icon: 'success',

                                    });
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                } else {
                                    Toast.fire({
                                        title: data.message,
                                        icon: 'error',
                                    });
                                }
                                destroyAllModals();
                            }
                        });

                    } else {
                        $(".editError").text("Sélectionner au moins 1 réponse.")
                        setTimeout(function() {
                            $(".editError").text("");
                        }, 2000);

                    }

                }

            });


            // remove Edit button
            $(document).on('click', '.removeEditButton', function() {
                $(this).closest('.editAnswers').remove();
            });

            // remove Answers
            $(document).on('click', ".removeAnswer", function() {

                var ansId = $(this).attr('data-id');

                $.ajax({

                    url: "{{ route('admin.qnaans-module.deleteAns') }}",
                    type: "GET",
                    data: {
                        id: ansId
                    },
                    success: function(data) {
                        if (data.success == true) {
                            Toast.fire({
                                title: data.message,
                                icon: 'success',

                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        } else {
                            Toast.fire({
                                title: data.message,
                                icon: 'error',
                            });
                        }
                        destroyAllModals();
                    }
                });

            });
        });
    </script>
@endpush
