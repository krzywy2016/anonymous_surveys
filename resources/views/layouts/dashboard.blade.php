<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Surveys by Kamil Krzywonos</title>
    {{-- Vue --}}
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js" integrity="sha512-QkuqGuFAgaPp3RTyTyJZnB1IuwbVAqpVGN58UJ93pwZel7NZ8wJOGmpO1zPxZGehX+0pc9/dpNG9QdL52aI4Cg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .spinner-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .fa-spinner {
            font-size: 2em;
        }
    </style>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="https://getbootstrap.com/docs/4.6/assets/brand/bootstrap-solid.svg" width="30" height="30"
                    class="d-inline-block align-top" alt="">
                Bootstrap
            </a>
            
            <div class="ml-auto">
                <!-- Tutaj umieść kod do wyświetlania zalogowanego użytkownika -->
                @auth
                    Witaj, {{ Auth::user()->name }}
                    <form action="{{ route('logout') }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link">Wyloguj się</button>
                    </form>
                @endauth
            </div>
        </nav>        
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
                                    <img src="{{ asset('placeholder.png') }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{% survey.title %}</h5>
                                        <p class="card-text">{% survey.description %}</p>
                                        <p class="card-text"><small class="text-muted">Dodana: {% formatUpdateTime(survey.updated_at) %}</small></p>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            delimiters: ['{%', '%}'],
            csrfToken: "{{ csrf_token() }}",
            data: {
                loading: true,
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
                    errors = {},
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
                        this.getSurveys();
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
