@extends('layouts.dashboard')

@section('content')
    <h1>Apartments:</h1>

    <div class="row row-cols-4">

        @foreach ($apartments as $apartment)
            {{-- Single apartment --}}

            <div class="col">
                <div class="card mb-3" style="width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-title">{{$apartment->title}}</h5>
                        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                        <a href="#" class="btn btn-primary">Read apartment</a>
                    </div>

                </div>
            </div>
        @endforeach

    </div>
@endsection