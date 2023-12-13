<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Surveys by Kamil Krzywonos</title>
    {{-- Vue --}}
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="https://getbootstrap.com/docs/4.6/assets/brand/bootstrap-solid.svg" width="30" height="30"
                class="d-inline-block align-top" alt="">
            Bootstrap
        </a>
    </nav>
    <div class="container" id="app">
        <div class="row mt-5">
            <button class="btn btn-dark" {{-- data-toggle="modal" data-target="#surveyModal" --}} @click="openModal()">Nowa
                ankieta</button>
        </div>
        <div class="row mt-3">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-dark mr-1" @click="showRecentSurveys"><i class="far fa-clock"></i> Ostatnio dodane</button>
                <button type="button" class="btn btn-dark" @click="showFilledSurveys"><i class="far fa-check-square"></i> Ostatnio wypełnione</button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <div class="card mb-3">
                    <img src="{{ asset('placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card mb-3">
                    <img src="{{ asset('placeholder.png') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
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
                    <!-- Dodaj formularz ankietowy Vue -->
                    <form @submit.prevent="submitSurvey">
                        <div class="form-group">
                            <label for="surveyTitle">Tytuł ankiety:</label>
                            <input type="text" class="form-control" v-model="surveyTitle" required>
                        </div>
                        <div class="form-group">
                            <label for="surveyDescription">Opis ankiety:</label>
                            <textarea class="form-control" v-model="surveyDescription" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Dodaj ankietę</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ... reszta kodu ... -->

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                surveyTitle: '',
                surveyDescription: '',
            },
            methods: {
                showRecentSurveys() {
                    /* this.displayRecent = true;
                    this.displayFilled = false; */
                },
                showFilledSurveys() {
                    /* this.displayRecent = false;
                    this.displayFilled = true; */
                },
                openModal() {
                    $('#surveyModal').modal('show');
                    console.log('klikniete')
                },
                closeModal() {
                    $('#surveyModal').modal('hide');
                },
                submitSurvey() {
                    // Wysyłanie ankiety za pomocą Axios
                    axios.post('/api/surveys', {
                            title: this.surveyTitle,
                            description: this.surveyDescription,
                        })
                        .then(response => {
                            console.log('Ankieta dodana!', response.data);
                            // Dodaj logikę obsługi po udanym dodaniu ankiety
                            // np. odświeżenie listy ankiet itp.
                            this.closeModal();
                        })
                        .catch(error => {
                            console.error('Błąd dodawania ankiety:', error.response.data);
                            // Dodaj logikę obsługi błędu
                        });
                },
            },
            mounted: function() {
                console.log('test');
            },
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
