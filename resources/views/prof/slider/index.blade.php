@extends('layouts.app')
@section('title')
    Liste des slides
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Liste des slides</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>Nom du slide</th>
                                        <th>Cours</th>
                                        <th>Module</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sliders as $slider)
                                        <tr>
                                            <td>{{$slider->name}}</td>
                                            <td>{{ $slider->modulesSliders->coursesModules->name }}</td>
                                            <td>
                                                @if ($slider->modulesSliders)
                                                    {{ $slider->modulesSliders->name }}
                                                @else
                                                    Aucun module
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ route('prof.slider.show', $slider->id) }}" class="btn btn-secondary">Afficher</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">Pas de slide</td>
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
