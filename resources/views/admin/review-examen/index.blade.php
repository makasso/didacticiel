@extends('layouts.app')
@section('title')
    Etudiants Examens
@endsection
@include('admin.module.modal-form')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Etudiants Examens</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Examen</th>
                                        <th>Statut</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($examensAttempts) > 0)

                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($examensAttempts as $examensAttempt)
                                        <tr>
                                            <td>{{ $x++ }}</td>
                                            <td>{{ $examensAttempt->user->name }}</td>
                                            <td>{{ $examensAttempt->examen->name }}</td>
                                            <td>
                                                @if ($examensAttempt->status == 0)
                                                    <span class="text-danger">En attente</span>
                                                @else
                                                    <span class="text-success">Approuvé</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($examensAttempt->status == 0)
                                                    <a href="#" class="reviewExamen" style="text-decoration: none;" data-id="{{$examensAttempt->id}}" data-bs-toggle="modal" data-bs-target="#reviewExamenModal">Review & Approved</a>
                                                @else
                                                    Complété
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
        
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Aucun étudiant n'a passé d'examen!</td>
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

@endpush
