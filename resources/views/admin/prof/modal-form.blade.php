
<!-- Modal add course -->
<div class="modal fade" id="addCoursesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un Cours</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addCoursesForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="user_id"  id="addUserId" class="form-control">
                    <table class="table" id="coursesTable">
                        <thead>
                            <th>Selectionner</th>
                            <th>Nom</th>
                        </thead>
                        <tbody class="addBodyCourses">

                        </tbody>
                    </table>

                    {{-- <select name="question" multiple multiselect-search="true" multiselect-select-all="true" onchange="console.log(this.selectedOption)">
                        <option value="hii">Hii</option>
                    </select> --}}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter Cours</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal show question module -->
<div class="modal fade" id="seeCoursesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cours</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table class="table">
                    <thead>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Action</th>
                    </thead>
                    <tbody class="seeCoursesTable">

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

