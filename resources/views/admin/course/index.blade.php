@extends('layouts.app')
@section('title')
    Liste des Cours
@endsection
@include('admin.course.modal-form')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des cours</h4>
                        </div>
                        <a href="{{ route('admin.course.create') }}" class="btn btn-primary float-end">Ajouter Cours</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Nom</th>
                                        <th>Catégorie</th>
                                        <th>Nombre Modules</th>
                                        <th>Professeurs</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($courses as $course)
                                        <tr>
                                            <td>{{ $course->name }}</td>
                                            <td>
                                                @if ($course->categoriesCourses)
                                                    {{ $course->categoriesCourses->name }}
                                                @else
                                                    Aucune catégorie
                                                @endif

                                            </td>
                                            <td>{{ $course->modulesCourses->count() }}</td>
                                            <td>
                                                <a href="#" class="seeTeachers" data-id="{{ $course->id }}"
                                                    data-toggle="modal" data-target="#seeTeachersModal"
                                                    style="text-decoration: none">Afficher Professeurs</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.course.edit', $course) }}"
                                                    class="btn btn-success">Modifier</a>

                                                <a href="{{ route('admin.course.show', $course->id) }}" class="btn btn-secondary">Afficher</a>
                                                <a href="{{ route('admin.course.destroy', $course) }}"
                                                    class="btn btn-danger" data-confirm-delete="true">Supprimer</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Aucun cours</td>
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
        $('.seeTeachers').click(function() {

            var id = $(this).attr('data-id');

            $.ajax({
                url: "{{ route('admin.course.getTeachers') }}",
                type: "GET",
                data: {
                    course_id: id
                },
                success: function(data) {

                    console.log(data);
                    var html = '';
                    var teachers = data.data;


                    if (teachers.length > 0) {

                        for (let i = 0; i < teachers.length; i++) {

                            html += `
                    <tr>
                        <td>` + (i + 1) + `</td>
                        <td>` + teachers[i]['name'] + `</td>
                    </tr>
                `;

                        }

                    } else {

                        html += `
                <tr>
                    <td colspan="2" class="text-center">Aucun professeur pour l'instant!</td>
                </tr>
            `;

                    }
                    $('.seeTeachersTable').html(html);

                }
            });

        });
    </script>
@endpush
