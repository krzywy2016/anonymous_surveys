<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Surveys by Kamil Krzywonos</title>
        {{-- Bootstrap --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        {{-- Vue --}}
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        {{-- Axios Moment Sweetalert --}}
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js" integrity="sha512-QkuqGuFAgaPp3RTyTyJZnB1IuwbVAqpVGN58UJ93pwZel7NZ8wJOGmpO1zPxZGehX+0pc9/dpNG9QdL52aI4Cg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- FontAwesome --}}
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

            .menu {
                position: absolute;
                top: 100%;
                left: 0;
                width: max-content;
                display: flex;
                flex-direction: column;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                white-space: nowrap;
            }

            .menu-item {
                padding: 8px;
                text-decoration: none;
                color: #333;
                transition: background-color 0.3s;
            }

            .menu-item:hover {
                background-color: #f0f0f0;
            }
        </style>
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

        {{-- jQuery, Popper.js, and Bootstrap JS --}}
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    </body>
</html>
