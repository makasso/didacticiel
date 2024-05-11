@extends('layouts.app')
@section('title')
    Liste des sociétés
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des sociétés</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Id</th>
                                        <th>Nom</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($companies as $company)
                                        <tr>
                                            <td>{{ $company->id }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td class="d-flex align-items-center justify-content-start">
                                                <a href="{{ route('admin.company.edit', $company->id) }}"
                                                    class="btn btn-success mr-1">Modifier</a>
                                                <a href="{{ route('admin.company.destroy', $company->id) }}" data-confirm-delete="true" class="btn btn-danger btn-delete">Supprimer</a>    
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Aucune société</td>
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
@endpush
