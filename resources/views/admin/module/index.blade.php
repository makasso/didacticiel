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
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped">
                                <thead>
                                    <tr class="ligth">
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Cours</th>
                                        <th>Essais</th>
                                        <th>Ajouter quiz</th>
                                        <th>Afficher Quiz</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($modules as $module)
                                        <tr>
                                            <td>{{ $module->id }}</td>
                                            <td>{{ $module->name }}</td>
                                            <td>
                                                @if ($module->coursesModules)
                                                    {{ $module->coursesModules->name }}
                                                @else
                                                    Aucun cours
                                                @endif
        
                                            </td>
                                            <td>{{ $module->attempt }} fois</td>
        
                                            <td>
                                                <a href="#" class="addQuestionModule" data-id="{{ $module->id }}" data-toggle="modal" data-target="#addQuizModalModule" style="text-decoration: none">Ajouter Question</a>
                                            </td>
                                            <td>
                                                <a href="#" class="seeQuestionModule" data-id="{{ $module->id }}" data-toggle="modal" data-target="#seeQuizModalModule" style="text-decoration: none">Afficher Questions</a>
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('admin.module.edit', $module->id) }}" class="btn btn-success mr-1">Modifier</a>
                                                <a href="{{ route('admin.module.destroy', $module->id) }}" class="btn btn-danger" data-confirm-delete="true" data-toggle="modal">Supprimer</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Aucun module trouvé</td>
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

        // add questions part in examen
        $('.addQuestionModule').click(function(){

            var id = $(this).attr('data-id');

            $('#addModuleId').val(id);

            $.ajax({

                url:"{{ route('admin.quiz.module') }}",
                type: "GET",
                data:{module_id:id},
                success:function(data){

                    if (data.success == true) {

                        var questions = [];
                        questions = data.data;
                        html = '';
                        if (questions.length > 0) {

                            for (let i = 0; i < questions.length; i++) {

                                html +=`
                                    <tr>
                                        <td><input type="checkbox" value="`+questions[i]['id']+`" name="questions_ids[]"></td>
                                        <td>`+questions[i]['question']+`</td>
                                    </tr>
                                `;

                            }
                        }
                        else {
                            html += `
                                <tr>
                                    <td colspan="2" class="text-center">Pas de questions!</td>
                                </tr>
                            `;
                        }
                        $('.addBodyModule').html(html);

                    }
                    else {
                        alert(data.message);
                    }

                }

            });

        });



        // submit add question in module
        $('#addQuizModule').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('admin.quiz-add.module') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if (data.success == true) {
                        location.reload();
                    }
                    else{
                        alert(data.message);
                    }
                }
            });

        });

        // see question examen
        $('.seeQuestionModule').click(function(){

            var id = $(this).attr('data-id');

            $.ajax({
                url:"{{ route('admin.quiz-show.module') }}",
                type:"GET",
                data:{module_id:id},
                success:function(data){

                    // console.log(data);
                    var html = '';
                    var questions = data.data;

                    if ( questions.length > 0) {

                        for (let i = 0; i < questions.length; i++) {

                            html +=`
                                <tr>
                                    <td>`+(i+1)+`</td>
                                    <td>`+questions[i]['question'][0]['question']+`</td>
                                    <td>
                                        <button class="btn btn-danger deleteQuestionModule" data-id="`+questions[i]['id']+`">Supprimer</button>
                                    </td>
                                </tr>
                            `;

                        }

                    }
                    else {

                        html +=`
                            <tr>
                                <td colspan="1" class="text-center">Aucune question disponible!</td>
                            </tr>
                        `;

                    }
                    $('.seeQuestionTableModule').html(html);

                }
            });

        });


        // delete see question in module
        $(document).on('click', '.deleteQuestionModule', function(){

            var id = $(this).attr('data-id');
            var obj = $(this);
            $.ajax({
                url:"{{ route('admin.quiz-delete.module') }}",
                type:"GET",
                data:{id:id},
                success:function(data){
                    if (data.success == true) {
                        obj.parent().parent().remove();
                    }
                    else {
                    alert(data.message);
                    }
                }
            });

        });


    });
</script>
 
@endpush
