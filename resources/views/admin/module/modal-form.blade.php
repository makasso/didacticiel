
<!-- Modal add question module -->
<div class="modal fade" id="addQuizModalModule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un Quiz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addQuizModule">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="module_id"  id="addModuleId" class="form-control">
                    <table class="table" id="questionsTableModule">
                        <thead>
                            <th>Selectionner</th>
                            <th>Question</th>
                        </thead>
                        <tbody class="addBodyModule">

                        </tbody>
                    </table>

                    {{-- <select name="question" multiple multiselect-search="true" multiselect-select-all="true" onchange="console.log(this.selectedOption)">
                        <option value="hii">Hii</option>
                    </select> --}}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter Quiz</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal show question module -->
<div class="modal fade" id="seeQuizModalModule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <th>Action</th>
                    </thead>
                    <tbody class="seeQuestionTableModule">

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

