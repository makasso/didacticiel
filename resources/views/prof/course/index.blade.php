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
                                        <th>Nom</th>
                                        <th>Nombre Module</th>
                                        <th>Liste des étudiants</th>
                                        <th>Copié Lien</th>
                                        <th>Action</th>
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
                                            <td>{{$course->name}}</td>
                                            <td>{{count($course->modulesCourses)}}</td>
                                            <td><a href="{{ route('prof.course.students', $course->id) }}">Liste des étudiants</a></td>
                                            <td>
                                                <a href="#" data-code="{{ $course->copy_link }}" class="copy"><i class="ri-file-copy-fill"></i></a>
                                            </td>
                                            <td><a href="{{ route('prof.course.show', $course->id) }}" class="btn btn-secondary">Afficher</a></td>
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

<script>
    $(document).ready(function(){

        $('.copy').click(function(){
            $(this).parent().prepend('<span class="copied_text">Lien copié</span>');

            var code = $(this).attr('data-code');
            var url = "{{URL::to('/')}}/cours/"+code;

            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            document.execCommand("copy");
            $temp.remove();

            setTimeout(() => {
                $('.copied_text').remove();
            }, 1500);
        });

    });
</script>
@endpush
