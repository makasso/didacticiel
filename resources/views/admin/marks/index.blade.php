@extends('layouts.app')
@section('title')
    Liste des Notes
@endsection
@include('admin.module.modal-form')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des Notes</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>N°</th>
                                        <th>Nom Examen</th>
                                        <th>Notes</th>
                                        <th>Total Notes</th>
                                        <th>Notes Passées</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($examens) > 0)
                                    @php
                                        $x = 1;
                                    @endphp
                                    @forelse ($examens as $examen)
                                        <tr>
                                            <td> {{ $x++ }}</td>
                                            <td> {{ $examen->name }}</td>
                                            <td> {{ $examen->marks }}</td>
                                            <td> {{ count($examen->getQnaExamens) * $examen->marks }}</td>
                                            <td> {{ $examen->pass_marks}}</td>

                                            <td>
                                                <button class="btn btn-primary editMarks" data-id="{{ $examen->id }}" data-pass-marks="{{ $examen->pass_marks }}" data-marks="{{ $examen->marks }}" data-totalq="{{ count($examen->getQnaExamens)}}"
                                                      data-toggle="modal" data-target="#editMarksModal">
                                                    Modifier
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Aucune note trouvé!</td>
                                        </tr>
                                    @endforelse
                                @else
                                    <tr>
                                        <td colspan="5">Aucun examen ajouté!</td>
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
