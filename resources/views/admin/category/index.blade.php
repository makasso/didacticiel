@extends('layouts.app')
@section('title')
    Liste des catégories
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des catégories</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Id</th>
                                        <th>Nom</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                            <td class="d-flex align-items-center justify-content-start">
                                                <a href="{{ url('admin/category/' . $category->id . '/edit') }}"
                                                    class="btn btn-success mr-1">Modifier</a>
                                                <a href="{{ route('admin.category.destroy', $category) }}" data-confirm-delete="true" class="btn btn-danger btn-delete">Supprimer</a>    
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Aucune catégorie</td>
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
