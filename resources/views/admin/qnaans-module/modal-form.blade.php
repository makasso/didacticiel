
    {{-- Start modal add question and answers --}}
    <div class="modal fade" id="addQuizModal" tabindex="-1" role="dialog" aria-labelledby="addQuizModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Question</h5>

                <button id="addAnswer" class="ml-5 btn btn-info">Ajouter Réponse</button>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addQna">
                @csrf
                <div class="modal-body addModalAnswers">
                    <div class="form-group mb-3">
                        <div class="col">
                            <input type="text" class="form-control m-input" name="question" required placeholder="Entrez une question">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <select required class="form-control" name="course_id">
                            <option value="">--Sélectionnez le cours--</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"> {{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="error" style="color: red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter Question</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    {{-- End modal add question and answers --}}

    {{-- Start modal Show answer --}}
    <div class="modal fade" id="showAnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Afficher les réponses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>N°</th>
                        <th>Réponse</th>
                        <th>Correct ?</th>
                    </thead>
                    <tbody class="showAnswers">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <span class="error" style="color: red;"></span>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
            </div>
        </div>
    </div>
    {{-- End modal add Show answer --}}


    {{-- Start modal edit question and answers --}}
    <div class="modal fade" id="editQnaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Question</h5>

                <button id="addEditAnswer" class="ml-5 btn btn-info">Ajouter Réponse Question</button>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editQna">
                @csrf
                <div class="modal-body editModalAnswers">
                    <div class="form-group mb-3">
                        <div class="col">
                            <input type="hidden" name="question_id" id="question_id">
                            <input type="text" class="form-control m-input" name="question" id="question" required placeholder="Entrez la question">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="editError" style="color: red;"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Modifier Question</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    {{-- End modal edit question and answers --}}
    
