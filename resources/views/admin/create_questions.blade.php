@extends('layouts.dashboard')

@section('content')
    <div class="container" id="app">
        <div class="row mt-2">
            <h3>{{ $survey->title }}</h3>
        </div>
        <div class="row">
            {{ $survey->description }}
        </div>
        {{-- Modal z wyborem typu pytania --}}
        <div id="chooseModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-1">
                            <div class="col-12">
                                Wybierz typ pytania
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button @click="addQuestion('text')" type="button" class="btn btn-light mr-1"><i
                                        class="fas fa-keyboard"></i> Tekstowe</button>
                                <button @click="addQuestion('singleChoice')" type="button" class="btn btn-light mr-1"><i
                                        class="fas fa-align-center"></i> Testowe</button>
                                <button @click="addQuestion('yesNo')" type="button" class="btn btn-light mr-1"><i
                                        class="far fa-thumbs-up"></i> Tak/Nie</button>
                                <button @click="addQuestion('multiChoice')" type="button" class="btn btn-light"><i
                                        class="fas fa-poll-h"></i> Wielokrotny</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sekcja pytań --}}
        <div v-for="(question, index) in questions" :key="index" class="card mb-3 mt-3">
            <div class="card-header bg-info">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" @click="toggleQuestion(index)">
                        <span class="text-white font-weight-bold">Pytanie {% index + 1 %}</span>
                    </button>
                    <span class="float-right">
                        <button v-if="index > 0" class="btn btn-link btn-sm" @click="moveQuestionUp(index)">
                            <span class="text-white"><i class="fas fa-arrow-up"></i></span>
                        </button>
                        <button v-if="index < questions.length - 1" class="btn btn-link btn-sm"
                            @click="moveQuestionDown(index)">
                            <span class="text-white"><i class="fas fa-arrow-down"></i></span>
                        </button>
                        <button class="btn btn-link btn-sm" @click="deleteQuestion(index)">
                            <span class="text-white"><i class="far fa-trash-alt"></i></span>
                        </button>
                    </span>
                </h5>
            </div>
            <div :id="'collapseQuestion' + index" class="collapse">
                <div class="card-body">
                    <label>Pytanie</label>
                    <input type="text" v-model="question.text" class="form-control">

                    {{-- Pola odpowiedzi w zależności od typu odpowiedzi --}}
                    <div v-if="question.answerType === 'singleChoice'">
                        <label>Odpowiedzi</label>
                        <div v-for="(choice, choiceIndex) in question.choices" :key="choiceIndex">
                            <div class="form-check mt-1">
                                <input class="form-check-input mt-3" type="radio" v-model="question.selectedChoice"
                                    :value="choice">
                                <label class="form-check-label">
                                    <input type="text" v-model="choice.text" class="form-control">
                                </label>
                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                    @click="removeChoice(index, choiceIndex)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-sm mt-2" @click="addChoice(index)">
                            <i class="fas fa-plus"></i> Dodaj opcję
                        </button>
                    </div>

                    <div v-if="question.answerType === 'multiChoice'">
                        <label>Odpowiedzi</label>
                        <div v-for="(choice, choiceIndex) in question.choices" :key="choiceIndex">
                            <div class="form-check mt-1">
                                <input class="form-check-input mt-3" type="checkbox" v-model="choice.selected">
                                <label class="form-check-label">
                                    <input type="text" v-model="choice.text" class="form-control">
                                </label>
                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                    @click="removeChoice(index, choiceIndex)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-sm mt-2" @click="addChoice(index)">
                            <i class="fas fa-plus"></i> Dodaj opcję
                        </button>
                    </div>

                    <div v-if="question.answerType === 'yesNo'">
                        <p>Odpowiedzi: Tak/Nie</p>
                    </div>

                    <div v-if="question.answerType === 'text'">
                        <p>Odpowiedzi będą udzielane jako tekst.</p>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" @click="chooseQuestionType" class="btn btn-success mt-3"><i class="fas fa-plus"></i>
            Dodaj pytanie</button>
        <button type="submit" @click="saveSurvey" class="btn btn-primary mt-3"><i class="far fa-save"></i> Zapisz
            ankietę</button>
        <button type="submit" @click="openSettingsModal" class="btn btn-primary mt-3"><i class="fas fa-cog"></i>
            Ustawienia ankiety</button>

        <div class="row mb-3"></div>

        <!-- Modal z suwakami ustawień -->
        <div class="modal" id="settingsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ustawienia ankiety</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="closeSettingsModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Status ankiety:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="publishedRadio" value="published"
                                v-model="surveyStatus">
                            <label class="form-check-label" for="publishedRadio">
                                Opublikowana
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="unpublishedRadio" value="unpublished"
                                v-model="surveyStatus">
                            <label class="form-check-label" for="unpublishedRadio">
                                Nieopublikowana
                            </label>
                        </div>

                        <label>Stan ankiety:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="openRadio" value="open"
                                v-model="surveyState">
                            <label class="form-check-label" for="openRadio">
                                Otwarta
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="closedRadio" value="closed"
                                v-model="surveyState">
                            <label class="form-check-label" for="closedRadio">
                                Zamknięta
                            </label>
                        </div>

                        <label>Slug ankiety:</label>
                        <input type="text" class="form-control" v-model="surveySlug">

                        <!-- Dodaj inne suwaki i ustawienia według potrzeb -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            @click="closeSettingsModal">Zamknij</button>
                        <button type="button" class="btn btn-primary" @click="saveSettings">Zapisz</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vue')
    <script>
        new Vue({
            el: '#app',
            delimiters: ['{%', '%}'],
            csrfToken: "{{ csrf_token() }}",
            data: {
                questions: [],
                settings: [],
                surveyStatus: '',
                surveyState: '',
                surveySlug: '',
                surveyId: {{$survey->id}}
            },
            methods: {
                chooseQuestionType() {
                    $('#chooseModal').modal('show');
                },
                addQuestion(questionType) {
                    $('#chooseModal').modal('hide');
                    // Dodawanie nowego pytania do tablicy
                    this.questions.push({
                        text: '',
                        answerType: questionType,
                        choices: [],
                    });
                },
                deleteQuestion(index) {
                    // Logika usuwania pytania
                    if (confirm("Czy na pewno chcesz usunąć to pytanie?")) {
                        this.questions.splice(index, 1);
                    }
                },
                toggleQuestion(index) {
                    // Logika otwierania/zamykania pytania
                    const collapseId = 'collapseQuestion' + index;
                    $('#' + collapseId).collapse('toggle');
                },
                moveQuestionUp(index) {
                    // Przesuń pytanie w górę
                    const temp = this.questions[index];
                    this.questions.splice(index, 1);
                    this.questions.splice(index - 1, 0, temp);
                },
                moveQuestionDown(index) {
                    // Przesuń pytanie w dół
                    const temp = this.questions[index];
                    this.questions.splice(index, 1);
                    this.questions.splice(index + 1, 0, temp);
                },
                addChoice(questionIndex) {
                    this.questions[questionIndex].choices.push({
                        text: '',
                        selected: false
                    });
                },
                removeChoice(questionIndex, choiceIndex) {
                    this.questions[questionIndex].choices.splice(choiceIndex, 1);
                },
                openSettingsModal() {
                    $('#settingsModal').modal('show');
                },
                closeSettingsModal() {
                    $('#settingsModal').modal('hide');
                },
                saveSettings() {
                    console.log('Zapisano ustawienia:', this.settings);

                    this.settings = {
                        surveyStatus: this.surveyStatus,
                        surveyState: this.surveyState,
                        surveySlug: this.surveySlug,
                    };

                    this.closeSettingsModal();
                },
                saveSurvey() {
                    const dataToSend = {
                        questions: this.questions,
                        settings: this.settings,
                        surveyId: this.surveyId
                    };

                    axios.post('../api/question-create', dataToSend)
                        .then(response => {
                            console.log('Odpowiedź z serwera:', response.data);

                            // window.location.href = '/thank-you-page';
                        })
                        .catch(error => {
                            console.error('Błąd podczas wysyłania danych:', error);
                        });
                }
            },
        });
    </script>
@endsection
