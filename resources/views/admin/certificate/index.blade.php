@extends('layouts.app')
@section('title')
    Liste des Certificats
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des certificats</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Matricule Certificat</th>
                                        <th>Etudiant</th>
                                        <th>Cours</th>
                                        <th>Date de délivrance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($certificates as $certificate)
                                        <tr>
                                            <td>
                                                {{ $certificate->certificate_id }}
                                            </td>
                                            <td>
                                                {{ $certificate->student->firstname . ' ' . $certificate->student->lastname }}
                                            </td>
                                            <td>{{ $certificate->examen->coursesExamens->name }}</td>
                                            <td>{{ $certificate->created_at->format('d-m-Y') }}</td>
                                            <td><a href="{{ route('admin.certificate.show', $certificate->id) }}" class="btn btn-secondary">Afficher</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Pas de certficats pour l'instant</td>
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
                    url: 'cdn.datatables.net/plug-ins/2.0.7/i18n/fr-FR.json',
                },
                "columnDefs": [{
                    "searchable": false,
                    "targets": [1, 2, 3, 4, 5],
                }, ]
            });
        });
    </script>
@endpush
