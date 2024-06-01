@extends('layouts.app')
@section('title')
    Liste des Modules
@endsection
@include('admin.module.modal-form')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des Modules</h4>
                        </div>
                        <a href="{{ route('prof.course.index') }}"
                            class="btn btn-primary float-end">Retour</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Nom</th>
                                        <th>Cours</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($modules as $module)
                                        <tr>
                                            <td>{{ $module->name }}</td>
                                            <td>
                                                @if ($module->coursesModules)
                                                    {{ $module->coursesModules->name }}
                                                @else
                                                    Aucun cours
                                                @endif
        
                                            </td>        
                                            
                                            <td>
                                                <a href="{{ route('prof.course.show-module', ['course_id' => $module->course_id, 'module_id' => $module->id]) }}" class="btn btn-secondary">Afficher</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Aucun module trouvé</td>
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

</script>
 
@endpush
