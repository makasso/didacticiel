<!-- Modal update examen -->
<div class="modal fade" id="updateExamenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Examen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading.remove>
                <form id="updateExamen" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="formExamenId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Selectionner Cours</label>
                            <select name="course_id" id="course_id" required class="form-control">
                                <option value="">--Selectionnez Cours--</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"> {{ $course->name }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Nom Examen</label>
                            <input type="text" id="name" name="name" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal show examen -->
<div class="modal fade" id="showExamenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showExamenName"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Cours</label>
                    <input disabled type="text" id="examen_course" value="" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nom Examen</label>
                    <input type="text" id="examen_name" name="name" value="" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>

<!-- Modal add question examen -->
<div class="modal fade" id="addQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addQna">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="examen_id" id="addExamenId" class="form-control">
                    <br /><br />

                    <table class="table" id="questionsTable">
                        <thead>
                            <th>Sélectionner</th>
                            <th>Question</th>
                        </thead>
                        <tbody class="addBody">

                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal show question examen -->
<div class="modal fade" id="seeQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Questions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table">
                    <thead>
                        <th>N°</th>
                        <th>Question</th>
                        <th>Supprimer</th>
                    </thead>
                    <tbody class="seeQuestionTable">

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
