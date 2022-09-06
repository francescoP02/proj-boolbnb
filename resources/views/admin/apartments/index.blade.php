@extends('layouts.dashboard')

@section('content')
    <h1>Apartments:</h1>

    <div class="row row-cols-3">

        @foreach ($apartments as $apartment)
            {{-- Single apartment --}}

            <div class="col">
                {{-- <div class="card mb-3" style="width: 18rem;">

                    @if ($apartment->image)
                        <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}" style="height: 200px">

                    @else 

                        <img class="card-img-top" src="https://help.iubenda.com/wp-content/plugins/accelerated-mobile-pages/images/SD-default-image.png" alt="" style="height: 200px">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{$apartment->title}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->id]) }}" class="btn btn-primary">Read apartment</a>
                    </div>

                </div> --}}

                <div class="card mb-3" style="width: 18rem;">

                    <div class="card-body">
                        <div class="_img_wrap">
                            @if ($apartment->image)
                                <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}" style="height: 200px">
                            @else 
                                <img class="card-img-top" src="https://help.iubenda.com/wp-content/plugins/accelerated-mobile-pages/images/SD-default-image.png" alt="" style="height: 200px">
                            @endif
                        </div>

                        <h5 class="card-title">{{$apartment->title}}</h5>
                        <p class="card-text">{{ $apartment->address }}</p>
                        <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->id]) }}" class="btn btn-primary">Read apartment</a>
                    </div>

                </div>

                {{-- <div class="card mb-3">

                    <div class="card-body">

                        <div class="img-wrap" v-if="apartment.image">
                            <img :src="apartment.image" alt="" />
                        </div>
                        
                        <h5 class="card-title text-start mt-2">{{ apartment.title }}</h5>
                        <p class="text-start">{{ apartment.address }}</p>
                        <router-link :to="{ name: 'single-apartment', params: { slug: apartment.slug } }" class="card-link">View Details</router-link>

                    </div>

                </div> --}}

            </div>
        @endforeach

    </div>
@endsection