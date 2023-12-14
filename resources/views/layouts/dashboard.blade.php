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
            <a class="navbar-brand" href="{{route('dashboard')}}">
                <img src="{{asset('logo3.png')}}" width="30" height="30"
                    class="d-inline-block align-top" alt="">
                Surveys
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
        @yield('content')      
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    @yield('vue')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
