@extends('layouts.app')
@section('title')
    Liste des Examens
@endsection

@include('admin.examen.modal-form');

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des Examens</h4>
                        </div>
                        <a href="{{ route('admin.examen.create') }}" class="btn btn-primary float-end">Ajouter Examen</a>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="light">
                                        <th>Nom</th>
                                        <th>Cours</th>
                                        <th>Ajouter Question</th>
                                        <th>Afficher Question</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($examens as $examen)
                                        <tr>
                                            <td>{{ $examen->name }}</td>
                                            <td>
                                                @if ($examen->coursesExamens)
                                                    {{ $examen->coursesExamens->name }}
                                                @else
                                                    Aucun cours
                                                @endif

                                            </td>
                                            <td>
                                                <a href="#" class="addQuestion"
                                                    data-course-id="{{ $examen->coursesExamens->id }}"
                                                    data-examen-id="{{ $examen->id }}" data-toggle="modal"
                                                    data-target="#addQnaModal" style="text-decoration: none">Ajouter
                                                    Question</a>
                                            </td>
                                            <td>
                                                <a href="#" class="seeQuestion" data-id="{{ $examen->id }}"
                                                    data-toggle="modal" data-target="#seeQnaModal"
                                                    style="text-decoration: none">Afficher
                                                    Questions</a>
                                            </td>
                                            <td class="">
                                                <a href="#" data-id="{{ $examen->id }}"
                                                    class="btn btn-success mr-1 updateExamen" data-toggle="modal"
                                                    data-target="#updateExamenModal">Modifier</a>
                                                <a href="#" data-id="{{ $examen->id }}" data-toggle="modal"
                                                    data-target="#showExamenModal" class="btn btn-secondary show-examen">Afficher</a>
                                                <a href="{{ route('admin.examen.destroy', $examen->id) }}"
                                                    class="btn btn-danger" data-confirm-delete="true" data-toggle="modal"
                                                    data-target="#deleteExamenModal">Supprimer</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Aucun examen trouvé!</td>
                                        </tr>
                                    @endforelse
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
    <script>
        $(document).ready(function() {
            // add questions part in examen
            $('.addQuestion').click(function() {

                var examenId = $(this).attr('data-examen-id');
                var courseId = $(this).attr('data-course-id');

                $('#addExamenId').val(examenId);
                $('.addBody').empty();

                $.ajax({

                    url: "{{ route('admin.qna.examen') }}",
                    type: "GET",
                    data: {
                        examen_id: examenId,
                        course_id: courseId
                    },
                    success: function(data) {

                        if (data.success == true) {

                            var questions = data.data;
                            console.log(questions);

                            html = '';
                            if (questions.length > 0) {

                                for (let i = 0; i < questions.length; i++) {

                                    html += `
                                    <tr>
                                        <td><input type="checkbox" value="` + questions[i]['id'] + `" name="questions_ids[]"></td>
                                        <td>` + questions[i]['question'] + `</td>
                                    </tr>
                                `;
                                }
                            } else {
                                html += `
                                <tr>
                                    <td class="text-center" colspan="2">Pas de questions!</td>
                                </tr>
                            `;
                            }
                            $('.addBody').html(html);

                        } else {
                            $('.addBody').html(html);

                        }

                    }

                });

            });

            // submit add question in module
            $('#addQuiz').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.quiz-add.module') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
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
                    }
                });

            });

            // see question examen
            $('.seeQuestion').click(function() {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('admin.qna-show.examen') }}",
                    type: "GET",
                    data: {
                        examen_id: id
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        var questions = data.data;
                        console.log(questions);

                        if (data.success && questions.length > 0) {

                            for (let i = 0; i < questions.length; i++) {
                                html += `
                                <tr>
                                    <td>` + (i + 1) + `</td>
                                    <td>` + questions[i]['question'][0]['question'] + `</td>
                                    <td>
                                        <button class="btn btn-danger deleteQuestion" data-id="` + questions[i][
                                    'id'
                                ] + `">Supprimer</button>
                                    </td>
                                </tr>
                            `;

                            }
                        } else {

                            html += `
                            <tr>
                                <td class="text-center" colspan="3">Aucune question disponible!</td>
                            </tr>
                        `;

                        }
                        $('.seeQuestionTable').html(html);

                    }
                });

            });

            // delete see question in module
            $(document).on('click', '.deleteQuestion', function() {

                var deleteExamenId = $(this).attr('data-id');
                var obj = $(this);
                $.ajax({
                    url: "{{ route('admin.qna-delete.examen') }}",
                    type: "GET",
                    data: {
                        id: deleteExamenId,
                    },
                    success: function(data) {
                        if (data.success == true) {
                            obj.parent().parent().remove();
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

            });

            // submit add question in examen
            $('#addQna').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.qna-add.examen') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
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

            });

            $('.updateExamen').click(function() {

                var updateExamenId = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('admin.qna.index') }}",
                    type: "GET",
                    data: {
                        id: updateExamenId,
                    },
                    success: function(data) {
                        var data = data.data
                        console.log(data);

                        $('#formExamenId').val(updateExamenId);

                        $('#course_id').val(data.course_id);
                        $('#name').val(data.name);
                        $('#time').val(data.time);
                        $('#date').val(data.date);
                        $('#attempt').val(data.attempt);
                    }
                });
            });

            $('.show-examen').click(function() {

                var showExamenId = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('admin.qna.index') }}",
                    type: "GET",
                    data: {
                        id: showExamenId,
                    },
                    success: function(data) {
                        var data = data.data

                        $('#examen_course').val(data.course_id);
                        $('#examen_name').val(data.name);
                        $('#showExamenName').text('Examen ' + data.name);
                    }
                });
            });

            $('#updateExamen').submit(function(e) {
                e.preventDefault();
                var examenId = $('#formExamenId').val();
                $(this).attr('action', `/admin/examen/${examenId}/update`);

                e.target.submit();
            });

        });
    </script>
@endpush
