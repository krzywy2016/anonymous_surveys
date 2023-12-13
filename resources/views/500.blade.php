@extends('layout')

@section('content')
<div class="container mt-2">
    <div class="row d-flex justify-content-center pt-3">
        <div class="col-3">
            <img src="{{asset('error.jpg')}}" class="logo" width="292"><br />
        </div>
        <div class="col-6 mt-5">
            <h1>Upssss... coś poszło nie tak</h1>
            <span>Nasz zespół dostał już powiadomienie i sprawdzi co się stało.</span>
            <p class="mt-3"><a href="{{route('home')}}"><button type="button" class="btn btn-success">Wróć do strony głównej</button></a></p>
        </div>
    </div>
</div>
@endsection
