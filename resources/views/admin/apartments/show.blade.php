@extends('layouts.dashboard')

@section('content')
    <div class="pb-4">
        {{-- <h1>
            <span class="fw-bold">{{$apartment->title}}</span>
            @if ($apartment->visible === 1)
            <span class="text-success fw-bold fs-6">Visible</span>            
            @elseif ($apartment->visible === 0)
            <span class="text-danger fw-bold fs-6">Not Visible</span>            
            @endif
        </h1> --}}

        {{-- <p>{{$apartment->address}}</p> --}}


        {{-- @if ($apartment->image)
            <img src="{{ asset('storage/' . $apartment->image) }}" style="width: 70%" alt="">
        @endif --}}


        {{-- <p>{{$apartment->slug}}</p> --}}

        {{-- <p>Number of rooms: {{$apartment->rooms_number}}</p> --}}
        {{-- <p>Number of beds: {{$apartment->beds_number}}</p> --}}
        {{-- <p>Number of bathrooms: {{$apartment->bathroom_number}}</p>
        <p>Square metres: {{$apartment->square_metres}} square metres</p> --}}



        {{-- test --}}

        <h1>
            <span class="fw-bold">{{ $apartment->title }}</span>
            @if ($apartment->visible === 1)
                <span class="text-success fw-bold fs-6">Visible</span>
            @elseif ($apartment->visible === 0)
                <span class="text-danger fw-bold fs-6">Not Visible</span>
            @endif
        </h1>

        <p>{{ $apartment->address }}</p>


        <div id="_img_info_section" class="">
            <div class="img-wrap-single-apt">
                @if ($apartment->image)
                    <img src="{{ asset('storage/' . $apartment->image) }}" alt="">
                @endif
            </div>

            <div id="_info_box" class="ms-lg-3">
                <p>Number of rooms: <span class="fw-bold">{{ $apartment->rooms_number }} </span><i
                        class="fas fa-door-open"></i></p>
                <p>Number of beds: <span class="fw-bold">{{ $apartment->beds_number }} </span><i class="fas fa-bed"></i></p>
                <p>Number of bathroom: <span class="fw-bold">{{ $apartment->bathroom_number }} </span><i
                        class="fas fa-bath"></i></p>
                <p>Square metres: <span class="fw-bold">{{ $apartment->square_metres }} m²</span></p>
                {{-- @if ($user && $user->name && $user->surname)
                    <p>
                        <span>inserito da: </span>
                        <span class="fw-bold">{{$user->name}} {{$user->surname}}</span>
                    </p>
                    @endif --}}
            </div>
        </div>

        <div class="my-4">
            <h4>You will find</h4>
            @forelse ($apartment->optionals as $optional)
                <span class="fs-4">
                    @if ($optional->id == 1)
                        <i class="fas fa-wifi"></i>
                    @endif
                    @if ($optional->id == 2)
                        <i class="fas fa-swimmer"></i>
                    @endif
                    @if ($optional->id == 3)
                        <i class="fas fa-spa"></i>
                    @endif
                    @if ($optional->id == 4)
                        <i class="fas fa-water"></i>
                    @endif
                    @if ($optional->id == 5)
                        <i class="fas fa-dog"></i>
                    @endif
                    {{ $optional->name }} {{ $loop->last ? '' : ' | ' }}
                </span>
            @empty
                nessun optional
            @endforelse

        </div>

        <div>
            <a class="btn btn-primary text-white"
                href="{{ route('admin.apartments.edit', ['apartment' => $apartment->id]) }}"><span class="text-white"><i
                        class="fas fa-edit"></i></span></a>
            <button class="btn btn-danger text-white" type="button" onclick="sureOfDelete()"><span class="text-white"><i
                        class="fas fa-trash-alt"></i></span></button>
            <a class="btn btn-info text-white"
                href="{{ route('admin.messages.index', ['apartment' => $apartment->id]) }}"><span class="text-white"><i
                        class="fas fa-envelope"></i></span></a>
            <a class="btn btn-success text-white"
                href="{{ route('admin.sponsored.index', ['apartment' => $apartment->id]) }}"><span class="text-white"><i
                        class="fas fa-dollar-sign"></i></span></a>
        </div>

    </div>

    <div id="_deleteBox" class="_bg_wrap d-none">
        <div class="bg-light d-inline-block p-4 fw-bold rounded position-absolute bottom-50 end-50 text-center">
            <p class="text-black">Sure you want to delete?</p>
            <div>
                <button id="_cancelButton" class="btn btn-primary text-white" onclick="sureOfDelete()">Cancel</button>
                <form class="d-inline-block"
                    action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger text-white" type="submit">Delete</i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function sureOfDelete() {
        const deleteBox = document.getElementById('_deleteBox');
        deleteBox.classList.toggle('d-none');
    }

    // function cancelDelete() {
    //     const cancelButton = document.getElementById('_cancelButton');
    //     cancelButton.classList.add('d-none');
    // }
</script>
