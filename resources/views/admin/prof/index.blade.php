@extends('layouts.app')
@section('title')
    Liste des Professeurs
@endsection
@include('admin.prof.modal-form')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des Professeurs</h4>
                        </div>
                        <a href="{{ route('admin.prof.create') }}" class="btn btn-primary float-end">Ajouter Professeur</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="light">
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Societé</th>
                                        <th>Date d'expiration</th>
                                        <th>Assigner Cours</th>
                                        <th>Afficher Cours</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->matricule }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->companyUser->name ?? 'Aucune société' }}</td>
                                            <td>{{ $user->expiry_date }}</td>
                                            <td>
                                                <a href="#" class="addCourses" data-id="{{ $user->id }}"
                                                    data-toggle="modal" data-target="#addCoursesModal"
                                                    style="text-decoration: none">Assigner Cours</a>
                                            </td>
                                            <td>
                                                <a href="#" class="seeCourses" data-id="{{ $user->id }}"
                                                    data-toggle="modal" data-target="#seeCoursesModal"
                                                    style="text-decoration: none">Afficher Cours</a>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.prof.edit', $user) }}"
                                                    class="btn btn-success mr-1">Modifier</a>
                                                <a href="{{ route('admin.prof.show', $user) }}" class="btn btn-secondary mr-1">Afficher</a>
                                                <a href="{{ route('admin.prof.destroy', $user) }}"
                                                    data-confirm-delete="true" class="btn btn-danger">Supprimer</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Aucun prof pour le moment</td>
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
            $('.addCourses').click(function() {

                var id = $(this).attr('data-id');

                $('#addUserId').val(id);

                $.ajax({

                    url: "{{ route('admin.prof.courses') }}",
                    type: "GET",
                    data: {
                        user_id: id
                    },
                    success: function(data) {

                        if (data.success == true) {

                            var courses = data.data;
                            html = '';
                            if (courses.length > 0) {

                                for (let i = 0; i < courses.length; i++) {

                                    html += `
                        <tr>
                            <td><input type="checkbox" value="` + courses[i]['id'] + `" name="courses_ids[]"></td>
                            <td>` + courses[i]['name'] + `</td>
                        </tr>
                    `;

                                }
                            } else {
                                html += `
                    <tr>
                        <td colspan="2" class="text-center">Pas de cours!</td>
                    </tr>
                `;
                            }
                            $('.addBodyCourses').html(html);

                        } else {
                            alert(data.message);
                        }

                    }

                });

            });



            // submit add question in module
            $('#addCoursesForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.prof.add.courses') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            Toast.fire({
                                title: data.message,
                                icon: 'success',

                            });
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
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
            $('.seeCourses').click(function() {

                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('admin.prof.show.courses') }}",
                    type: "GET",
                    data: {
                        user_id: id
                    },
                    success: function(data) {

                        // console.log(data);
                        var html = '';
                        var courses = data.data;

                        if (courses.length > 0) {

                            for (let i = 0; i < courses.length; i++) {

                                html += `
                    <tr>
                        <td>` + (i + 1) + `</td>
                        <td>` + courses[i]['name'] + `</td>
                        <td>
                            <button class="btn btn-danger deleteCourse" data-user-id="${id}" data-course-id="` + courses[i]['id'] + `">Supprimer</button>
                        </td>
                    </tr>
                `;

                            }

                        } else {

                            html += `
                <tr>
                    <td colspan="3" class="text-center">Aucun cours assigné!</td>
                </tr>
            `;

                        }
                        $('.seeCoursesTable').html(html);

                    }
                });

            });

            // delete see question in module
            $(document).on('click', '.deleteCourse', function() {

                var courseId = $(this).attr('data-course-id');
                var userId = $(this).attr('data-user-id');

                var obj = $(this);
                $.ajax({
                    url: "{{ route('admin.prof.delete.course') }}",
                    type: "GET",
                    data: {
                        user_id: userId,
                        course_id: courseId
                    },
                    success: function(data) {
                        if (data.success == true) {
                            obj.parent().parent().remove();
                            Toast.fire({
                                title: data.message,
                                icon: 'success',

                            });

                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        } else {
                            Toast.fire({
                                title: data.message,
                                icon: 'error',
                            });
                        }
                    }
                });

            });
        });
    </script>
@endpush
