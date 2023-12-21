@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row mt-5">
        <button class="btn btn-dark" @click="openModal()">
            <i class="fas fa-poll-h"></i> Nowa ankieta
        </button>
    </div>
    <div class="row mt-5">
        <div class="btn-group" role="group">
            <button type="button" :class="{ 'btn': true, 'btn-secondary': !recentSurveysActive, 'btn-info': recentSurveysActive, 'mr-1': true }" @click="getSurveys">
                <i class="far fa-clock"></i> Ostatnio dodane
            </button>
            <button type="button" :class="{ 'btn': true, 'btn-secondary': !filledSurveysActive, 'btn-info': filledSurveysActive }" @click="getCompletedSurveys">
                <i class="far fa-check-square"></i> Ostatnio wypełnione
            </button>
        </div>
    </div>
    <div class="row mt-3 mb-5 pl-0">
        <div class="col-12 pl-0">
            <div v-if="loading" class="spinner-container">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
            <template v-else>
                <div class="row">
                    <div v-for="survey in surveys" :key="survey.id" class="col-12 col-md-6 col-lg-4">
                        <div class="card mb-3" style="height: 100%;">
                            <a :href="'/edit-survey/' + survey.id">
                                <img src="{{ asset('placeholder.png') }}" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <a :href="'/edit-survey/' + survey.id" style="text-decoration: none">
                                <h5 class="card-title">{% survey.title %}</h5>
                                <p class="card-text">{% survey.description %}</p>
                                </a>
                                <p class="card-text pt-2"><small class="text-muted">Dodana: {% formatUpdateTime(survey.updated_at) %}</small></p>
                                <div class="dropdown" style="position: absolute; bottom: 0; right: 0; margin: 10px;">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item" href="#">Opcja 1</a>
                                    </div>
                                </div>
                                
                                <div class="dropdown" style="position: absolute; bottom: 0; right: 0; margin: 10px;">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item" :href="'/show-survey/' + survey.id" target="_blank"><i class="fas fa-stream"></i> Przejdź do ankiety</a>
                                        <a href="#" class="dropdown-item" @click.prevent="deleteSurvey(survey.id)"><i class="far fa-trash-alt"></i> Usuń ankietę</a>
                                    </div>
                                </div>
                                
                                <template v-if="survey.state == 'published'">
                                    <small>
                                        <p style="color: green"><i class="fas fa-circle"></i> Ankieta otwarta</p>
                                    </small>
                                </template>
                                <template v-if="survey.state == 'unpublished'">
                                    <small>
                                        <p style="color: red"><i class="fas fa-circle"></i> Ankieta zamknięta</p>
                                    </small>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>                
            </template>
        </div>
    </div>
</div>


<!-- Dodaj modal -->
<div id="surveyModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dodaj nową ankietę</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="submitSurvey">
                    <div class="form-group">
                        <label for="surveyTitle">Tytuł ankiety:</label>
                        <input type="text" class="form-control" v-model="form.surveyTitle">
                        <small v-if="errors.surveyTitle" class="text-danger pt-1">{% errors.surveyTitle[0] %}</small>
                    </div>
                    <div class="form-group">
                        <label for="surveyDescription">Opis ankiety:</label>
                        <textarea class="form-control" v-model="form.surveyDescription"></textarea>
                        <small v-if="errors.surveyDescription" class="text-danger pt-1">{% errors.surveyDescription[0] %}</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Dodaj ankietę</button>
                    <div v-if="loading2" class="spinner-container">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </form>
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
            loading: true,
            loading2: false,
            recentSurveysActive: true,
            filledSurveysActive: false,
            surveys: [],
            form: {
                surveyTitle: '',
                surveyDescription: '',
            },
            errors: {}
        },
        methods: {
            openModal() {
                $('#surveyModal').modal('show');
            },
            closeModal() {
                $('#surveyModal').modal('hide');
            },
            submitSurvey() {
                this.errors = {},
                this.loading2 = true,
                axios.post("{{route('surveyCreate')}}", {
                    data: this.form
                })
                .then(response => {
                    this.closeModal();
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else {
                        this.errors = {};
                    }
                })
                .finally(() => {
                    this.loading2 = false;
                    this.getSurveys();
                    this.form = {};
                });
            },
            getSurveys() {
                this.recentSurveysActive = true;
                this.filledSurveysActive = false,
                this.loading = true;
                axios.get("{{route('getSurveys')}}", {
                    //
                }).then(response => {
                    this.surveys = response.data;
                }).catch(error => {
                    //
                })
                .finally(() => {
                    this.loading = false;
                });
            },
            deleteSurvey(id) {
                this.loading = true;
                axios.get("delete-survey/" + id)
                .then(response => {
                    //
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    } else {
                        this.errors = {};
                    }
                })
                .finally(() => {
                    this.loading = false;
                    this.getSurveys();
                });
            },
            getCompletedSurveys() {
                this.recentSurveysActive = false;
                this.filledSurveysActive = true,
                this.loading = true;
                axios.get("{{route('getSurveys')}}", {
                    //
                }).then(response => {
                    this.surveys = response.data;
                }).catch(error => {
                    //
                })
                .finally(() => {
                    this.loading = false;
                });
            },
            formatUpdateTime(updatedAt) {
                return moment(updatedAt).format('DD.MM.YYYY HH:mm');
            },
        },
        mounted: function() {
            this.getSurveys();
        },
    });
</script>
@endsection