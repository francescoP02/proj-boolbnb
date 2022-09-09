@extends('layouts.dashboard')

@section('content')
    <div class="pt-3 row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5">

        @foreach ($apartments as $apartment)
            {{-- Single apartment --}}

            <div class="col">

                <a href="{{ route('admin.apartments.show', ['apartment' => $apartment->id]) }}"
                    class="card-link text-decoration-none">
                    <div class="_my_card bg-transparent mb-3 position-relative">
                        <div class="card-body ">
                            <!-- image -->
                            <div class="img-wrap">
                                @if ($apartment->image)
                                    <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}">
                                @else
                                    <img src="https://help.iubenda.com/wp-content/plugins/accelerated-mobile-pages/images/SD-default-image.png"
                                        alt="">
                                @endif
                            </div>

                            <!-- text -->
                            <div class="px-2 mb-4">
                                <h5 class="card-title text-start mt-3 text-break">{{ $apartment->title }}</h5>
                                <p class="text-start my-2 text-break">{{ $apartment->address }}</p>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        @endforeach

    </div>
@endsection
