@extends('layouts.app')
@section('title')
    Liste des Etudiants
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des étudiants</h4>
                        </div>
                            <div class="btn-group">
                                <a href="{{ route('prof.course.index') }}"
                            class="btn btn-primary float-end">Retour</a>
                            <a href="{{ route('prof.course.students.csv', $course_id) }}"
                            class="btn btn-secondary float-end">Exporter (CSV)</a>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Adresse Email</th>
                                        <th>Date de complétion</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td>
                                                {{ $student->student->firstname }}
                                            </td>
                                            <td>
                                                {{ $student->student->lastname }}
                                            </td>
                                            <td>{{$student->student->email}}</td>
                                            <td>{{ $student->student->created_at->format('d-m-Y') }}</td>
                                            @if ($student->is_completed == 1)
                                            <td class="text-success">Terminé</td>
                                            @else
                                            <td class="text-warning">En cours</td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td  class="text-center" colspan="3">Aucun étudiant!</td>
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
            var language = require('datatables.net-plugins/i18n/fr-FR.js');

            $('#datatable').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "searching": true,
                language: {
                    url: 'cdn.datatables.net/plug-ins/2.0.5/i18n/fr-FR.json',
                },
                "columnDefs": [{
                    "searchable": false,
                    "targets": [1, 2, 3, 4, 5],
                }, ]
            });
        });
    </script>
@endpush
