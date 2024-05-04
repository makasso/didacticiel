@extends('layouts.app')
@section('title')
    Liste des Professeurs
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des Professeurs</h4>
                        </div>
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
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td>{{$user->matricule}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->company }}</td>
                                        <td>{{$user->expiry_date }}</td>
                                        <td>
                                            <a href="{{ route('admin.prof.edit', $user) }}" class="btn btn-success">Modifier</a>
                                            <a href="{{ route('admin.prof.destroy', $user) }}" data-confirm-delete="true" class="btn btn-danger">Supprimer</a>
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
@endpush
