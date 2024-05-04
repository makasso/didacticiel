<div class="modal fade" id="quizModule" tabindex="-1" aria-labelledby="quizModuleLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quizModuleLabel">Quiz {{ $module->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            @if (count($questions) > 0)
                                @if ($countModuleAttempts >= 2)
                                    <h5 class="text-center">Vous avez déjà passé un quiz pour ce module au moins deux
                                        fois!</h5>
                                @else
                                    <div class="iq-header-title">
                                        <h4 class="card-title quiz-question"></h4>
                                        <small>Cliquer sur la réponse pour la sélectionner. <b>NB:</b> Faites
                                            attention vous ne pourrez plus changer votre réponse!</small>
                                    </div>
                                    <span class="status font-weight-bold"></span>

                                    <div class="row align-items-center answers-box">

                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="button"
                                            class="btn d-none btn-primary mr-2 next-question">Suivant</button>
                                        <form method="POST" id="formCompleteQuiz" class="inline"
                                            action="{{ route('student.frontendModule.completeQuiz', $module->id) }}">
                                            @csrf
                                            <input type="hidden" name="marks" id="marks" value="">
                                            <button type="submit"
                                                class="btn btn-secondary d-none btn-finish">Terminer</button>
                                        </form>
                                    </div>
                                @endif
                            @else
                                <h5 class="text-center">Pas de questions pour l'instant!</h5>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
