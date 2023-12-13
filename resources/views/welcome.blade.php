<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Surveys by Kamil Krzywonos</title>
</head>

<body>

    <div class="container-fluid pt-5">
        <div class="row">
            <!-- Lewa strona (połowa ekranu) -->
            <div class="col-md-6">
                <div class="d-flex flex-column justify-content-center align-items-center h-100">
                    <!-- Przycisk do zalogowania -->
                    <a href="{{asset('/login')}}" class="btn btn-primary mb-3">Zaloguj się</a>
                    <!-- Przycisk do zarejestrowania -->
                    <a href="{{asset('/register')}}" class="btn btn-success">Zarejestruj się</a>
                </div>
            </div>
            <!-- Prawa strona (połowa ekranu) -->
            <div class="col-md-6">
                <div class="d-flex flex-column justify-content-center align-items-center h-100">
                    <!-- Miejsce na zdjęcie -->
                    <img src="https://via.placeholder.com/300" alt="Zdjęcie" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>
