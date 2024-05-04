@extends('layouts.app')
@section('title')
    Liste des Examens
@endsection

@include('prof.examen.modal-form');

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des Examens</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="light">
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Cours</th>
                                        <th>Date</th>
                                        <th>Durée</th>
                                        <th>Essais</th>
                                        <th>Questions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($examens as $examen)
                                        <tr>
                                            <td>{{ $examen->id }}</td>
                                            <td>{{ $examen->name }}</td>
                                            <td>
                                                @if ($examen->coursesExamens)
                                                    {{ $examen->coursesExamens->name }}
                                                @else
                                                    Aucun cours
                                                @endif

                                            </td>
                                            <td>{{ $examen->date }}</td>
                                            <td>{{ $examen->time }} Hrs</td>
                                            <td>{{ $examen->attempt }} Fois</td>
                                            <td>
                                                <a href="#" class="seeQuestion"
                                                    data-id="{{ $examen->id }}" data-toggle="modal"
                                                    data-target="#seeQnaModal" style="text-decoration: none">Afficher
                                                    Questions</a>
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
                    url: "{{ route('prof.qna-show.examen') }}",
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
                                </tr>
                            `;

                            }
                        } else {

                            html += `
                            <tr>
                                <td class="text-center" colspan="2">Aucune question disponible!</td>
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

            $('#updateExamen').submit(function(e) {
                e.preventDefault();
                var examenId = $('#formExamenId').val();
                $(this).attr('action', `/admin/examen/${examenId}/update`);

                e.target.submit();
            });

        });
    </script>
@endpush

