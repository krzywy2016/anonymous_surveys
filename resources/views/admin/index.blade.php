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
    <div class="row mt-3 pl-0">
        <div class="col-12 pl-0">
            <div v-if="loading" class="spinner-container">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
            <template v-else>
                <div class="row">
                    <div v-for="survey in surveys" :key="survey.id" class="col-3">
                        <div class="card mb-3">
                            <a :href="'/edit-survey/' + survey.id">
                                <img src="{{ asset('placeholder.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{% survey.title %}</h5>
                                    <p class="card-text">{% survey.description %}</p>
                                    <p class="card-text"><small class="text-muted">Dodana: {% formatUpdateTime(survey.updated_at) %}</small></p>
                                </div>
                            </a>
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
                axios.post("{{route('api.surveyCreate')}}", {
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
                axios.get("{{route('api.getSurveys')}}", {
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
            getCompletedSurveys() {
                this.recentSurveysActive = false;
                this.filledSurveysActive = true,
                this.loading = true;
                axios.get("{{route('api.getSurveys')}}", {
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