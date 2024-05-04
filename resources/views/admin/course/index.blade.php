@extends('layouts.app')
@section('title')
    Liste des Cours
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des cours</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Catégorie</th>
                                        <th>Prof</th>
                                        <th>Nom</th>
                                        <th>Nombre Module</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($courses as $course)
                                        <tr>
                                            <td>
                                                @if ($course->categoriesCourses)
                                                    {{ $course->categoriesCourses->name }}
                                                @else
                                                    Aucune catégorie
                                                @endif
        
                                            </td>
                                            <td>
                                                @if ($course->user)
                                                    {{ $course->user->name }}
                                                @else
                                                    Aucun professeur
                                                @endif
        
                                            </td>
                                            <td>{{$course->name}}</td>
                                            <td>{{$course->modulesCourses->count()}}</td>
                                            <td>
                                                <a href="{{ route('admin.course.edit', $course) }}" class="btn btn-success">Modifier</a>
                                                <a href="{{ route('admin.course.destroy', $course) }}"  class="btn btn-danger" data-confirm-delete="true">Supprimer</a>
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
@endpush
